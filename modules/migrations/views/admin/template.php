<?php echo 
"<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_". ucfirst($name) ." extends CI_Migration {

	public function up()
	{
		// upgrade
	}

	public function down()
	{
		// donwgrade
	}
}";