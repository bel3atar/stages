<?
class StudentModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function find($id)
	{
	}
	function findAll()
	{
		$students = [];
		foreach($this->db->query('SELECT * FROM students') as $r)
			$students[] = $r;
		return $students;
	}
};
