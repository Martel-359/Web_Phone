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

    public function __construct($pdo)
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
            move_uploaded_file($file[`tmp_name`],'uploads'.$this->hinh);
        }

        if(isset($data[`mo_ta`])){
            $this->mo_ta =$data['mo_ta'];
        }

        if(isset($data[`id_loai`])){
            $this->id_loai =$data[`id_loai`];
        }
        return $this;
    }

    protected function fillFromDB(array $row)
	{
		[
			'id' => $this->id,
			'ten_hang_hoa' => $this->ten_hang_hoa,
			'gia' => $this->gia,
            'so_luong_hang' => $this->so_luong_hang,
			'hinh' => $this->hinh,
            'mo_ta' => $this->mo_ta,
			'id_loai' => $this->id_loai,
            'id' => $this->id,
		] = $row;
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

    public  function all()
    {
        $hang_hoas=[];
        $get_data= $this->db->prepare('select * from hang_hoa');
        $get_data->execute();
        while ($row = $get_data->fetch()) {
			$hang_hoa = new hang_hoa($this->db);
			$hang_hoa->fillFromDB($row);
			$hang_hoas[] = $hang_hoa;   
		}
		return $hang_hoas;
    }

    public function have_id($id){
        $hang_hoas=[];
        $get_data=$this->db->prepare('SELECT * FROM hang_hoa WHERE id= :id');
        $get_data->execute(['id' => $id]);
        while ($row = $get_data->fetch()) {
			$hang_hoa = new hang_hoa($this->db);
			$hang_hoa->fillFromDB($row);
			$hang_hoas[] = $hang_hoa;   
		}
		return $hang_hoas;
    }
    public function all_have_idloai($id){
        $hang_hoas=[];
        $get_data=$this->db->prepare('SELECT * FROM hang_hoa WHERE id_loai = :id');
        $get_data->execute(['id' => $id]);
		while ($row = $get_data->fetch()) {
			$hang_hoa = new hang_hoa($this->db);
			$hang_hoa->fillFromDB($row);
			$hang_hoas[] = $hang_hoa;   
		}
		return $hang_hoas;
    }

    public function all_have_ten($ten){
        $hang_hoas=[];
        $get_data=$this->db->prepare("SELECT * FROM hang_hoa WHERE ten_hang_hoa LIKE :ten");
        $get_data->execute(['ten'=>"%$ten%"]);
        while ($row = $get_data->fetch()) {
			$hang_hoa = new hang_hoa($this->db);
			$hang_hoa->fillFromDB($row);
			$hang_hoas[] = $hang_hoa;   
		}
        return $hang_hoas;
        
    }





}

