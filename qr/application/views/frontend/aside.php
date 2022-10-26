                            <aside>
								<h3>Tin tức mới nhất</h3>
                                <?php foreach ($news_list as $row) : ?>
								<div class = "new_post">
									<a href = "#"><img class = "img-responsive margin0auto" src = "<?php echo base_url('uploads/news/'.$row->avatar); ?>" alt = "" /></a>
									<h4><a href = "<?php echo base_url('news/view/'.$row->id); ?>"><?php echo $row->name; ?></a></h4>
									<time><?php echo date('d/m/Y',$row->create_at); ?></time>
									<p><?php echo word_limiter($row->summary, 20); ?></p>
									<div class = "button_a">
										<a href = "<?php echo base_url('news/view/'.$row->id); ?>">Xem thêm</a>
									</div>
								</div>
                                <?php endforeach; ?>
								<img class = "img-responsive margin0auto space" src = "<?php echo common_helper::front_end(); ?>images/banner.png" alt = "" />
							</aside>