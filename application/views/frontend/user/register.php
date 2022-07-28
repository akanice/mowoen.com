                                            <br />
                                           	<h3>Đăng ký thành viên</h3>
                                            <br /><br />
                                            <form method = "POST">
												<div class="form-group">
													<label>Tên tài khoản</label>
													<input type="text" name = "name" class="form-control" value = "<?php echo set_value('name'); ?>" placeholder="Tên tài khoản của bạn">
                                                    <?php echo form_error('name'); ?>
												</div>
												<div class="form-group">
													<label>Mật khẩu</label>
													<input type="password" name = "password" class="form-control" placeholder="Nhập mật khẩu của bạn">
                                                    <?php echo form_error('password'); ?>
                                                </div>
												<div class="form-group">
													<label>Tên thật của bạn</label>
													<input type="text" name = "fullname" class="form-control" value = "<?php echo set_value('fullname'); ?>" placeholder="Nhập tên thật của bạn">
                                                    <?php echo form_error('fullname'); ?>
                                                </div>
												<div class="form-group">
													<label>Số điện thoại</label>
													<input type="text" name = "phone" class="form-control" value = "<?php echo set_value('phone'); ?>" value = "<?php echo set_value('name'); ?>" placeholder="Nhập số điện thoại của bạn">
                                                    <?php echo form_error('phone'); ?>
                                                </div>
												<div class="form-group">
													<label>Email</label>
													<input type="email" name = "email" class="form-control" value = "<?php echo set_value('email'); ?>"  placeholder="Nhập email của bạn">
                                                    <?php echo form_error('email'); ?>
                                                </div>
												<div class = "row margin0">
													<input type = "submit" name = "submit" class = "btn btn-lg btn-success" value = "Đăng ký" />
												</div>
											</form>
                                            <?php
                                                if(isset($message)){
                                                     $this->load->view('frontend/message', $this->data); 
                                                 }
                                             ?>
                                             
                                          

