<?php
                                $query = $pdo->prepare("SELECT * FROM slide");
                                $query->execute();
                                if($query->rowCount() != 0)
                                {
?>
								<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title"><span><i class="fas fa-home"></i>&nbsp;</span>หน้าหลัก</h4>
                                    </div>
                                    <div class="card-body">
                                        <h2 class="text-center" style="margin-top: 50px;"><strong>ประกาศข่าวสาร</strong></h2>
                                        <h5 class="text-center" style="margin-bottom: 50px;">จากทาง Server !</h5>
                                        <div class="carousel slide" data-ride="carousel" id="slide">
                                            <div class="carousel-inner" role="listbox">
												<?php
													$active = ' active';
                                   					while($slide = $query->fetch(PDO::FETCH_ASSOC))
													{
												?>
													<div class="carousel-item<?php echo $active; ?>">
														<img class="w-100 d-block" src="<?php echo $slide['image']; ?>" alt="Slide">
													</div>
												<?php
														$active = '';
													}
												?>
                                            </div>
												<?php
													if($query->rowCount() > 1)
													{
												?>
												<a class="carousel-control-prev" href="#slide" role="button" data-slide="prev">
													<span class="carousel-control-prev-icon"></span>
													<span class="sr-only">Previous</span>
												</a>
												<a class="carousel-control-next" href="#slide" role="button" data-slide="next">
													<span class="carousel-control-next-icon"></span>
													<span class="sr-only">Next</span>
												</a>
                                            <ol class="carousel-indicators">
												<?php
													$active = ' class="active"';
                                   					for ($x = 0; $x <= $query->rowCount()-1; $x++)
													{
														echo '<li data-target="#slide" data-slide-to="'.$x.'"'.$active.'></li>';
														$active = '';
													}
												?>
                                            </ol>
											<?php
													}
											?>
                                        </div>
                                    </div>
                                </div>
<?php
                                }
                                else
                                {
?>
                                    <div class="col-md-12">
                                        <div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                            <div class="card-header">
                                                <h4 class="card-header-title"><span><i class="fas fa-home"></i>&nbsp;</span>หน้าหลัก</h4>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="text-center" style="margin-top: 80px;">ประกาศข่าวสาร</h1>
                                                <h5 class="text-center" style="margin-bottom: 80px;">จากทาง Server !</h5>
                                                <div class="row">
                                                    <div class="col-md-12" style="margin-top:50px;margin-bottom:50px;">
                                                        <img src="../assets/img/error.png" alt="Smiley face" height="auto" width="100" style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;">
                                                        <h1 class="col text-center">แย่จังงงง ...</h1>
                                                        <h3 class="col text-center">ไม่มีประกาศในระบบ !</h3>
                                                    </div>
										        </div>
										    </div>
									    </div>
								    </div>
<?php
                                    }
?>
