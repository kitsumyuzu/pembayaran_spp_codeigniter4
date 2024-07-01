<?php namespace App\Models;

use CodeIgniter\Model;

class Schema extends Model {

	/* ---------------------------------------------------------------------- */

		public function visual($table) {

			return $this -> db -> table($table) -> get() -> getResult();

		}

		public function visual_join2($table1, $table2, $on) {

			return $this -> db -> table($table1) -> join($table2, $on, 'left') -> get() -> getResult();
		
		}

		public function visual_join3($table1, $table2, $table3, $on1, $on2) {

			return $this -> db -> table($table1) -> join($table2, $on1, 'left') -> join($table3, $on2, 'left') -> get() -> getResult();
			
		}

		public function visual_join4($table1, $table2, $table3, $table4, $on1, $on2, $on3) {

			return $this -> db -> table($table1) -> join($table2, $on1, 'left') -> join($table3, $on2, 'left') -> join($table4, $on3, 'left') -> get() -> getResult();
			
		}

	/* ---------------------------------------------------------------------- */

		public function add_data($table, $data) {

			return $this -> db -> table($table) -> insert($data);
		
		}
		
		public function edit_data($table, $data, $where) {
		
			return $this -> db -> table($table) -> update($data, $where);

		}
		
		public function delete_data($table, $where) {
		
			return $this -> db -> table($table) -> delete($where);
		
		}

	/* ---------------------------------------------------------------------- */

		public function getWhere($table, $where) {

			return $this -> db -> table($table) -> getWhere($where) -> getRow();
		
		}
		
		public function getWhere2($table, $where) {
		
			return $this -> db -> table($table) -> getWhere($where) -> getRowArray();
		
		}

	/* ---------------------------------------------------------------------- */

		public function countActiveAccount() {

			return $this -> db -> table('authentication_account') -> where('_status', 'active') -> where('_roles', '3') -> countAllResults();
			
		}

		public function countActiveDocument() {

			return $this -> db -> table('invoice') -> where('invoice_status', 'belum lunas') -> countAllResults();
			
		}

	/* ---------------------------------------------------------------------- */

		public function countActiveDocument_Student() {

			return $this -> db -> table('invoice') -> where('invoice_status', 'belum lunas') -> where('_invoiceId', session() -> get('id')) -> countAllResults();
			
		}

		public function countActiveDueDateDocument_Student() {

			return $this -> db -> table('invoice') -> where('invoice_status', 'denda') -> where('_invoiceId', session() -> get('id')) -> countAllResults();

		}
    
}