<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 6/18/2018
 * Time: 10:51 AM
 */

class Product_model extends CI_Model
{
    public function Save($data)
    {
        $qry = $this->db->insert('spares',$data);
        return $qry;
    }

    public function EditProduct($id)
	{
		$qry = $this->db->query("SELECT pd.id, 
											   pd.product_id, 
											   p.product_name,
											   p.product_desc, 
											   p.status,
											   pd.qty,
											   s.spare_name,
											   c.category_id,
											   c.category_desc,
											   s.spare_id
										FROM   product_detail AS pd 
											   JOIN products AS p 
												 ON p.product_id = pd.product_id 
											   JOIN spares AS s 
												 ON pd.spare_id = s.spare_id 
											   JOIN category c 
												 ON s.category_id = c.category_id 
										WHERE  pd.product_id = '$id' 
						");
		return $qry->result();
	}

    public function SparesGetById($id)
	{
		$this->db->get_where("", array("product_id" => $id));
	}

    public function GetSpareWithCategoryId($id)
    {
        $qry = $this->db->query("SELECT
                                           spares.spare_id,
                                           spares.spare_name,
                                           spares.spare_size,
                                           spares.spare_desc,
                                           spares.spare_quantity,
                                           spares.spare_reorder_level,
                                           category.category_desc 
                                        FROM
                                           category 
                                           JOIN
                                              spares 
                                              ON (category.category_id = spares.category_id) 
                                        WHERE
                                           category.category_id = '$id' 
                                           AND category.status = 'active' 
                                           AND spares.status = 'active'");

        return $qry->result();
    }

    public function GetProductByDetailsId($prod_id) {

    	$qry = $this->db->query("SELECT pd.id, 
									   pd.product_id, 
									   sp.category_id, 
									   sp.spare_id, 
									   pd.qty 
								FROM   product_detail AS pd 
									   JOIN spares AS sp 
										 ON ( pd.spare_id = sp.spare_id ) 
								WHERE  pd.product_id = '$prod_id'"
		);
    	return $qry->result();

	}

    public function UpdateProduct($data_product,$data_detail)
	{
        $prod_id = $data_product['product_id'];

		for($i=0; $i<count($data_detail['spare_id']); $i++)
		{
            $olddetails = $this->GetProductByDetailsId($prod_id[0]);
            $new = count($data_detail['spare_id']);

            if( count($olddetails) == $new && $olddetails[$i]->id == $data_detail['detail_id'][$i] && $data_detail['spare_id'][$i] !== $olddetails[$i]->spare_id ||
                count($olddetails) == $new && $olddetails[$i]->id == $data_detail['detail_id'][$i] && $data_detail['spare_id'][$i] == $olddetails[$i]->spare_id && $data_detail['qty'][$i] !== $olddetails[$i]->qty ||
                count($olddetails) == $new && $olddetails[$i]->id == $data_detail['detail_id'][$i] && $data_detail['spare_id'][$i] !== $olddetails[$i]->spare_id && $data_detail['qty'][$i] == $olddetails[$i]->qty) {
                $data = array(
                    'spare_id' => $data_detail['spare_id'][$i],
                    'qty' => $data_detail['qty'][$i]
                );

                $qry = $this->db->update("product_detail", $data, array('id' => $data_detail['detail_id'][$i]));
            } elseif (count($olddetails) !== $new && $olddetails[$i]->id !== $data_detail['detail_id'][$i] ||
                        count($olddetails) !== $new && $olddetails[$i]->id == $data_detail['detail_id'][$i] ) {

                    if($olddetails[$i]->id == '' && $data_detail['detail_id'][$i] == '')
                    {
                        $data = array(
                            'product_id' => $prod_id[0],
                            'spare_id' => $data_detail['spare_id'][$i],
                            'qty' => $data_detail['qty'][$i]
                        );
                        $qry = $this->db->insert("product_detail", $data);
                    } else {

                        $data = array(
                            'spare_id' => $data_detail['spare_id'][$i],
                            'qty' => $data_detail['qty'][$i]
                        );

                        $qry = $this->db->update("product_detail", $data, array('id' => $data_detail['detail_id'][$i]));
                    }

            }

           /* echo "<pre>";
            echo "-------------1-----------"."<br>";
            print_r($data);
           /* echo "-------------2-----------"."<br>";
            print_r($olddetails[$i]->id);
            echo "-------------3-----------"."<br>";
            print_r($data_detail['detail_id'][$i]. '-'. $olddetails[$i]->id);
            echo "-------------4-----------"."<br>";
            print_r($data_detail['detail_id']);
            echo "-------------5-----------"."<br>";
            echo "</pre>";*/

        }

        //exit;
        return $qry;
	}

    public function SaveProduct($data)
    {
        $this->db->insert("products", $data);
        return $this->db->insert_id();
    }

	public function Delete($id)
	{
		$qry = $this->db->delete('products', array('product_id' => $id));
		if($qry == 1)
		{
			$qry1 = $this->db->delete('product_detail', array('product_id' => $id));
		}
		else
		{
			return 0;
		}

		return $qry1;
	}

    public function SaveProductQuantity($data)
    {

      for($i=0; $i<count($data['spare_id']); $i++)
      {
            $data1 = array(
                'product_id' => $data['product_id'],
                'spare_id' => $data['spare_id'][$i],
                'qty' => $data['qty'][$i]
            );

            $qry = $this->db->insert("product_detail", $data1);
      }

        return $qry;
    }

    public function ProductStatusUpdate($id)
	{
		$prod = $this->EditProduct($id);

		if($prod[0]->status == 'active')
		{
			$qry = $this->db->update("products", array('status' => 'inactive'), array('product_id' => $id));
		}
		else
		{
			$qry = $this->db->update("products", array('status' => 'active'), array('product_id' => $id));
		}

		return $qry;
	}

	public function DeleteProductDetailById($id)
	{
		$qry = $this->db->delete("product_detail", array('id' => $id));
		return $qry;
	}
}
?>
