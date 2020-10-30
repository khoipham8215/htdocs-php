
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 col-md-0 col-sm-12 "></div>
		<div class="col-lg-4 col-md-6 col-sm-12 text-center flogin">
			<div class="col-12" id="tieude">Đăng nhập vào hệ thống !</div>
			<div class="col-12" id="flg">
			<form method="post" action="index.php?controller=login">
				<p><label id="hint"><i> (Tên đăng nhập và mật khẩu mặc định là mã đơn vị, nếu chưa có liên hệ BHXH để cung cấp) </i></label><br/></p><table class="table tblg"><tr>
				<td><label>Tên đăng nhập </label></td><td><input type="text" name="user" /></td></tr><tr>
				<td><label>Mật khẩu </label></td><td><input type="password" name="pwd" /></td></tr>
				<tr ><td colspan='2'><input type="submit" name="btlg" class ="btn-primary  btlg" onClick="login()" value="Đăng nhập"/> </tr></table>
			</form>
			</div>
		</div>
		<div class="col-lg-4 col-md-0 col-sm-12"></div>
	</div>	
</div>