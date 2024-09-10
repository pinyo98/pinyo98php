<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>


<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
	img#cimg2{
		height: 50vh;
		width: 100%;
		object-fit: contain;
		/* border-radius: 100% 100%; */
	}
</style>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<h5 class="card-title">จัดการข้อมูลในระบบ</h5>
			<!-- <div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_department" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
			</div> -->
		</div>

		<div class="card-body">
การจัดการล้างข้อมูลงบประมาณ จะทำให้ข้อมูลงบประมาณโครงการทั้งหมดในระบบสูญหาย เป็นการเริ่มต้นระบบใหม่ (กระทำเมื่อสิ้นปีงบประมาณ)	

<?php 
if(isset($_POST['submit']))
{
  $db = $_POST['db'];
  if($db=="clean"){		
//ติดต่อฐานข้อมูล	
$dbhost=DB_SERVER;
$dbuser=DB_USERNAME;
$dbpass=DB_PASSWORD;
$dbname=DB_NAME;
$mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
$mysqli->set_charset('utf8');
if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }else{
	$mysqli->query("DROP TABLE `running_balance`");
	$mysqli->query("TRUNCATE TABLE `categories` ");
	//นำเข้า Table DB
			$pa='database/running_balance.sql';
			$filePath = file_get_contents($pa);
			$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
			$mysqli->multi_query($filePath);
	
		echo "<span class='badge badge-warning'>ล้างข้อมูล โครงการต่างๆ ในระบบเรียบร้อยแล้ว ดำเนินการตั้งค่าโครงการได้ที่เมนู</span> > <a href='?page=maintenance/category'><span class='badge badge-success'>จัดการโครงการ</span></a>";
	exit;		
		}
mysqli_close($mysqli);

	}
}
?>
		</div>
		<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#alert1">
  ล้างข้อมูล
</button>
				
				</div>
			</div>
		</div>

	</div>
</div>

  <div class="modal fade" id="alert1" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <font color="red"><b>ล้างข้อมูลโครงการ</b></font>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
<form name="test" action="?page=database" method="post">
<input type="hidden" name="db" value="clean">
        <div class="modal-body pl">
          การกระทำนี้จะทำให้ข้อมูลโครงการสูญหายเป็นการเริ่มต้นระบบใหม่
        </div>
        <div class="modal-footer">
					<input type="submit" class="btn btn-info" name="submit" value="ตกลง">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        </div>
</form>
      </div>
    </div>
  </div>