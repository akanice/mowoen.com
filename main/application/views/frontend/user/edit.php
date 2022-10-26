        <br />
        <h3>Chỉnh sửa thông tin</h3>
        <br /><br />
        <form method = "POST">
            <table class = "table table-responsive table-bordered">
                <tr>
                    <td>Tên tài khoản</td>
                    <td><?php echo $user->name; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type = "email" name = "email" class = "form-control" value = "<?php echo $user->email; ?>" />
                        <?php echo form_error('email'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Họ và tên</td>
                    <td>
                        <input type = "fullname" name = "fullname" class = "form-control" value = "<?php echo $user->fullname; ?>" />
                        <?php echo form_error('fullname'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td><input type = "text" name = "phone" class = "form-control" value = "<?php echo $user->phone; ?>" />
                        <?php echo form_error('phone'); ?>
                    </td>
                </tr>
                 <tr>
                    <td>Mật khẩu</td>
                    <td>
                        <input type = "password" name = "password" class = "form-control" value = "" />
                        <?php echo form_error('password'); ?>
                    </td>
                </tr>
            </table>
            <input type = "submit" name = "submit" class = "btn btn-success" value = "Lưu" />
        </form>
        
        
