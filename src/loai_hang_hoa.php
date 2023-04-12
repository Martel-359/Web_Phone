<?php
namespace CT275\Labs;

use Error;

class loai_hang_hoa{
    private $db;

    public $id;
    public $ten_loai;
    private $errors=[];

    public function getId(){
        return $this->id;
    }

    public function __construct($pdo){
         $this->db=$pdo;
    }

    public function fill(array $data){
        $this->ten_loai= trim($data[`ten_loai`]);
        return $this;
    }

    protected function fillFromDB(array $row){
        [
            'id'=> $this->id,
            'ten_loai' => $this->ten_loai
        ] = $row;
        return $this;
    }

    public  function get_validate_error(){
        return $this->errors;
    }

    public  function all()
    {
        $loai_hang_hoas=[];
        $get_data= $this->db->prepare('select * from loai_hang_hoa');
        $get_data->execute();
        while ($row = $get_data->fetch()) {
			$loai_hang_hoa = new loai_hang_hoa($this->db);
			$loai_hang_hoa->fillFromDB($row);
			$loai_hang_hoas[] = $loai_hang_hoa;   
		}
		return $loai_hang_hoas;
    }
}