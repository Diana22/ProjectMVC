<?php
include_once __DIR__ .'/database.php';
class model_cake {
    var $id_cake;
    var $name_cake;
    var $price;
    var $weight;
    var $calories;

     public function __construct($id_cake, $name_cake, $price, $weight, $calories)
     {
         $this->id_cake = $id_cake;
         $this->name_cake = $name_cake;
         $this->price = $price;
         $this->weight = $weight;
         $this->calories = $calories;
     }




    public function load_by_id($id)
    {
        $db = model_database::instance();
        $sql = 'SELECT *
            FROM cake
            WHERE id_cake = ' .$id;
        if ($result = $db->get_row($sql)) {
            $this->cakes = array(
            'id_cake' => $result['id_cake'],
            'name_cake' => $result['name_cake'],
            'price' => $result['price'],
            'weight' => $result['weight'],
            'calories' => $result['calories']
            );
        }
        return $this->cakes;
    }

    public function get_all()
    {
        $db = model_database::instance();
        $sql = 'SELECT *
            FROM cake';
        $result = $db->get_rows($sql);
        return $result;
    }




    public function deleteCake($id)
    {
        $db = model_database::instance();
        $sql = 'DELETE FROM cake
            WHERE id_cake = '. $id;
        $db->execute($sql);
    }

    public function addCake($name_cake, $price, $weight, $calories)
    {
        $db = model_database::instance();
        $sql = 'INSERT INTO cake (name_cake, price, weight, calories) values (\'' . $name_cake . '\', ' . $price . ', ' . $weight . ', ' . $calories . ');';
        $db->execute($sql);
    }

    public function updateCake($id_cake, $name_cake, $price, $weight, $calories)
    {
        $db = model_database::instance();
        $sql = 'UPDATE cake
        SET name_cake =\'' .  $name_cake . '\', price =\'' . $price . '\', weight =\'' . $weight .'\', calories=\'' . $calories .'\'
        WHERE id_cake = \''. $id_cake . '\'';
        $db->execute($sql);
    }

}
