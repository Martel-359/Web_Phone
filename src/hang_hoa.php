<?php

namespace CT275\Labs;

class hang_hoa
{
	private $db;

	private $id = -1;
	public $ten_hang_hoa;
	public $gia;
	public $hinh;
	public $ngaynhap;
	public $id_loai;
	public $ten_loai;
	public $so_luong_hang;
	public $mo_ta;
	private $errors = [];

	public function getId()
	{
		return $this->id;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data, $FILES)
	{

		$this->ten_hang_hoa = trim($data['ten_hang_hoa']);


		if (isset($data['gia'])) {
			$this->gia = $data['gia'];
		}
		if (isset($_FILES['hinh'])) {
			$file = $_FILES['hinh'];
			$this->hinh = $file['name'];
			$upload_dir = 'uploads/';
			$upload_file = $upload_dir . $this->hinh;
			if (file_exists($upload_file)) {
				echo "File already exists.";
			} else {
				move_uploaded_file($file['tmp_name'], $upload_file);
			}
		}
		if (isset($data['id_loai'])) {
			$this->id_loai =  preg_replace('/\D+/', '', $data['id_loai']);
		}
		if (isset($data['so_luong_hang'])) {
			$this->so_luong_hang = trim($data['so_luong_hang']);
		}
		if (isset($data['mo_ta'])) {
			$this->mo_ta = trim($data['mo_ta']);
		}

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->ten_hang_hoa) {
			$this->errors['ten_hang_hoa'] = 'Tên không hợp lệ.';
		}
		if (!$this->gia) {
			$this->errors['gia'] = 'Giá không hợp lệ.';
		} elseif ($this->gia > 40000000) {
			$this->errors['gia'] = 'Giá không thể lớn hơn 40.000.000vnđ.';
		}
		if (!$this->hinh) {
			$this->errors['hinh'] = 'Hình ảnh không hợp lệ.';
		}
		if (!$this->so_luong_hang) {
			$this->errors['so_luong_hang'] = 'Số lượng không hôp lệ.';
		} elseif (($this->so_luong_hang) < 0 || ($this->so_luong_hang) > 1000) {
			$this->errors['so_luong_hang'] = 'Số lượng không được phép nhỏ hơn 0 và lớn hơn 500.';
		}
		return empty($this->errors); //
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


	public function COUNT()
	{
		$stmt = $this->db->prepare('select COUNT(id) from hang_hoa');
		$stmt->execute();
		$count = $stmt->fetch();
		$count1 = $count[0];
		return $count1;
	}
	protected function fillFromDB(array $row)
	{
		[
			'id' => $this->id,
			'ten_hang_hoa' => $this->ten_hang_hoa,
			'gia' => $this->gia,
			'hinh' => $this->hinh,
			'id_loai' => $this->id_loai,
			'so_luong_hang' => $this->so_luong_hang,
			'ngaynhap' => $this->ngaynhap,
			'mo_ta' => $this->mo_ta
		] = $row;
		return $this;
	}

	public function save(){
		$result = false;
		if ($this->id >= 0) {
			$stmt = $this->db->prepare('update hang_hoa set ten_hang_hoa = :ten_hang_hoa,
			gia = :gia, hinh = :hinh,mo_ta=:mo_ta,id_loai = :id_loai, so_luong_hang = :so_luong_hang, ngaynhap = now() where id = :id');
			$result = $stmt->execute([
				'ten_hang_hoa' => $this->ten_hang_hoa,
				'gia' => $this->gia,
				'hinh' => $this->hinh,
				'id_loai' => $this->id_loai,
				'so_luong_hang' => $this->so_luong_hang,
				'id' => $this->id,
				'mo_ta' => $this->mo_ta

			]);
		} else {
			$stmt = $this->db->prepare(
				'insert into hang_hoa (ten_hang_hoa, gia,so_luong_hang,hinh,mo_ta,id_loai,ngaynhap)
values (:ten_hang_hoa, :gia,:so_luong_hang, :hinh,:mo_ta,:id_loai,now())'
			);
			$result = $stmt->execute([
				'ten_hang_hoa' => $this->ten_hang_hoa,
				'gia' => $this->gia,
				'hinh' => $this->hinh,
				'id_loai' => $this->id_loai,
				'mo_ta' => $this->mo_ta,
				'so_luong_hang' => $this->so_luong_hang
			]);
			if ($result) {
				$this->id = $this->db->lastInsertId(); // lay id giao dich cuoi cung
			}
		}

		return $result;
	}
	public function find($id){
		$stmt = $this->db->prepare('SELECT * FROM hang_hoa WHERE id = :id');
		$stmt->execute(['id' => $id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		}
		return null;
	}
	public function update(array $data, $FILES)
	{
		$this->fill($data, $FILES);

		if ($this->validate()) {
			return $this->save();
		}
		return false;
	}
	public function delete()
	{
		$stmt = $this->db->prepare('delete from hang_hoa where id = :id');
		return $stmt->execute(['id' => $this->id]);
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