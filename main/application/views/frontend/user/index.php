        <br />
        <h3>Thông tin cá nhân</h3>
        <br /><br />
        <table class = "table table-responsive table-bordered">
            <tr>
                <td>Tên tài khoản</td>
                <td><?php echo $user->name; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $user->email; ?></td>
            </tr>
            <tr>
                <td>Họ và tên</td>
                <td><?php echo $user->fullname; ?></td>
            </tr>
            <tr>
                <td>Số điện thoại</td>
                <td><?php echo $user->phone; ?></td>
            </tr>
        </table>
        <a class = "btn btn-success" href = "<?php echo base_url('user/edit'); ?>">Sửa thông tin</a>
        
        
