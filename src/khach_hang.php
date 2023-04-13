<?php

namespace CT275\Labs;

class khach_hang{
	private $db;
	public $ten;
	public $id = -1;
	public $email;
    public $mat_khau;
    public $so_dien_thoai;
    public $dia_chi;
	private $errors = [];

	public function getId()
	{
		return $this->id;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{
		if (isset($data['email'])) {
			$this->email = trim($data['email']);
		}

		if (isset($data['mat_khau'])) {
			$this->mat_khau =hash("sha1",(trim($data['mat_khau'])));

		}
		if (isset($data['ten'])) {
			$this->ten = trim($data['ten']);
		}

		if (isset($data['dia_chi'])) {
			$this->dia_chi =trim($data['dia_chi']);

		}
		if (isset($data['so_dien_thoai'])) {
			$this->so_dien_thoai =trim($data['so_dien_thoai']);

		}
		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->email) {
			$this->errors['email'] = 'Email không được rỗng.';
		}
        if (!$this->mat_khau) {
			$this->errors['mat_khau'] = 'Mật khẩu không được rỗng.';
		}
		if (strlen($this->so_dien_thoai) < 10 || strlen($this->so_dien_thoai) > 11) {
			$this->errors['so_dien_thoai'] = 'Invalid phone number.';
		}


		return empty($this->errors);
	}

	public function all()
	{
		$khach_hangs = [];
		$stmt = $this->db->prepare('select * from khach_hang');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$khach_hang = new khach_hang($this->db);
			$khach_hang->fillFromDB($row);
			$khach_hangs[] = $khach_hang;
		}
		return $khach_hangs;
	}
	
	protected function fillFromDB(array $row) // truyen doi tuong tu db
	{
		[
			'id' => $this->id,
			'ten' => $this->ten,	
			'dia_chi' => $this->dia_chi,
			'so_dien_thoai' => $this->so_dien_thoai,
			'email' => $this->email,
            'mat_khau' => $this->mat_khau,

		] = $row;
		return $this;
	}

	public function save()
	{
		$result = false;
		if ($this->id >= 0) {
			$stmt = $this->db->prepare('update khach_hang set email = :email,
mat_khau = :mat_khau where id = :id');
			$result = $stmt->execute([
				'name' => $this->ten,
				'email' => $this->email,
				'notes' => $this->mat_khau,
				'id' => $this->id
			]);
		} else {
			$stmt = $this->db->prepare(
				'insert into khach_hang (ten,dia_chi,so_dien_thoai,email, mat_khau) values (:ten,:dia_chi,:so_dien_thoai,:email, :mat_khau)');
			$result = $stmt->execute([
				'email' => $this->email,
				'mat_khau' => $this->mat_khau,
				'ten' => $this->ten,
				'dia_chi' => $this->dia_chi,
				'so_dien_thoai' => $this->so_dien_thoai,
			]);
			if ($result) {
				$this->id = $this->db->lastInsertId();// lay id giao dich cuoi cung
			}
		}
		return $result;
	}
	public function find($id)
	{
		$stmt = $this->db->prepare('select * from khach_hang where id = :id');
		$stmt->execute(['id' => $id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		}
		return null;
	}
	public function update(array $data)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->save();
		}
		return false;
	}
	public function delete()
	{
		$stmt = $this->db->prepare('delete from khach_hang where id = :id');
		return $stmt->execute(['id' => $this->id]);
	}
}
