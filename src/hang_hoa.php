<?php
namespace CT275\Labs;

class hang_hoa{
    private $db;

    private $id=-1;
    public $ten_hang_hoa;
    public $gia;
    public $so_luong_hang;
    public $hinh;
    public $mo_ta;
    public $id_loai;
    private $errors=[];

    public function getId(){
        return $this->id;
    }

    public function fuction__construct($pdo)
	{
		$this->db = $pdo;
	}

    public function fill(array $data, $FILES){
        $this->ten_hang_hoa = trim($data[`ten_hang_hoa`]);


        if(isset($data[`gia`])){
            $this->gia =$data[`gia`];
        }

        if(isset($data[`so_luong_hang`])){
            $this->gia =$data[`so_luong_hang`];
        }

        if(isset($FILES[`hinh`])){
            $file=$FILES[`hinh`];
            $this->hinh =$file[`name`];
            move_uploaded_file($file[`tmp_name`],'/uploads/'.$this->hinh);
        }

        if(isset($data[`mo_ta`])){
            $this->mo_ta =$data['mo_ta'];
        }

        if(isset($data[`id_loai`])){
            $this->id_loai =$data[`id_loai`];
        }
        return $this;
    }

    public function get_validate_error(){
        return $this->errors;
    }

    public function validate(){
        if(!$this->ten_hang_hoa){
            $this->errors[`ten_hang_hoa`]='Vui lòng điền tên hàng hóa';
        }
        if(is_numeric($this->gia) && $this->gia>=0){
            $this->errors[`gia`]='Vui lòng chỉ nhập số lớn hơn hoặc bằng 0';
        }
        if(is_numeric($this->so_luong_hang) && $this->so_luong_hang>=1){
            $this->errors[`so_luong_hang`]='Số lượng hàng phải lớn hơn 1';
        }
        if(!$this->hinh){
            $this->errors[`ten_hang_hoa`]='Vui lòng thêm ảnh vào';
        }
        if(!$this->mo_ta){
            $this->errors[`mo_ta`]='Vui lòng thêm mô tả cho sản phẩm';
        }
        if(!$this->id_loai){
            $this->errors[`id_loai`]='Vui lòng chọn loại hàng hóa';
        }
    }








}

