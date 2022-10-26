        <br />
        <h3>Đăng nhập</h3>
        <br /><br />
        <form method="post">
            <div class="form-group">
                <label>Tên tài khoản</label> 
                <input type="text" name="name" class="form-control" placeholder="Tên tài khoản của bạn" /> 
                <?php echo form_error('name'); ?>
            </div>
            <div class="form-group">
                <label>Mật khẩu</label> 
                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu của bạn" />
                <?php echo form_error('password'); ?>
            </div>
            <input type = "submit" class = "btn btn-lg btn-success" name = "submit" value = "Đăng nhập" />
             <?php echo form_error('login'); ?>
        </form>
