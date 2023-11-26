<?php
class MyDestructableClass {
	public function __construct() {
		print "In constructor<br>";
		$this->name = "MyDestructableClass";
		
		// Register a custom shutdown function...above and beyond (called prior to) the natural destructor
		register_shutdown_function(array($this,"save"));
	}
	
	 function save(){
		//Save it here
		echo "save crnrstn!<br />";
	}
   
	private function goodbyeCrnrstn(){
		echo "goodbye crnrstn!<br />";
	}
   
	private function fail() {
		throw new Exception("Exception A!");
	}
 
	public function helloCrnrstn(){
		echo "hello crnrstn!<br />";
	
		try {
			$this->fail();
		} catch( Exception $e ) {
			print $e->getMessage()."<br />";
		}
	}
	
	public function __destruct() {
		$this->goodbyeCrnrstn();
		print "Destroying " . $this->name . "\n";
	}
}

$obj = new MyDestructableClass();
//
// http://www.php.net/manual/en/language.oop5.decon.php
// What you could do is write the constructor without any declared arguments, then iterate through the arguments given 
// and check their types/values to determine what other function to use as the constructor.
// 
// example of multiple constructors

class MyClass {

   // use a unique id for each derived constructor,
   // and use a null reference to an array, 
   // for optional parameters
   function __construct($id="", $args=null) {
       // parent constructor called first ALWAYS
       parent::__construct();

       echo "main constructor\n";

      // avoid null or other types
      $id = (string) $id;

      // allow default constructor
      if ($id == "") {  
         $id = "default";
      }

      // just in case, use lowercase id
      $id = "__cons_" .  strtolower($id);

      $rc = new ReflectionClass("MyClass");

      if (!$rc->hasMethod($id) {
         echo "constructor $id not defined\n";
      }
      else { 
        // using "method references"
        $this->$id($args);
      }

       $rc = null;
   } // function __construct

   // ALWAYS HAVE A default constructor,
   // that ignores arguments
   function __cons_default($args=null) {
       echo "Default constructor\n";
   }

   // may have other constructors that expect different
   // argument types or argument count
   function __cons_min($args=null) {
     if (! is_array($args) || count($args) != 2) {
       echo "Error: Not enough parameters (Constructor min(int $a, int $b)) !!!\n";
     }
     else {
         $a = (int) $args[0];
         $b = (int) $args[1];
         $c = min($a,$b);
         echo "Constructor min(): Result = $c\n";
     }
   }

   // may use string index (associative array),
   // instead of integer index (standard array) 
   function __cons_fullname($args=null) {
     if (! is_array($args) || count($args) < 2) {
       echo "Error: Not enough parameters (Constructor fullname(string $firstname, string $lastname)) !!!\n";
     }
     else {
         $a = (string) $args["firstname"];
         $b = (string) $args["lastname"];
         $c = $a . " " . $b;
         echo "Constructor fullname(): Result = $c\n";
     }
   }

} // class

// --> these two lines are the equivalent
$obj1 = new TestClass();
$obj2 = new TestClass("default");

// --> these two are specialized

// should be read as "$obj3 = new TestClass, min(99.7, 99.83);"
$obj3 = new TestClass("min", array(99.7, 99.83));

// should be read as "$obj4 = new TestClass, fullname("John", "Doe");"
$obj4 = new TestClass("fullname", array("firstname" => "John", "lastname" => "Doe"));

// --> these  two lack parameters
$obj5 = new TestClass("min", array());
$obj6 = new TestClass("fullname");


?>