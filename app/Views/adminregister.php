<div class="container-fluid bg-primary" style="height: 100%;">
    <div class="container" style="font-family: 'PT Sans', sans-serif;">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card my-5">
                    <div class="card-header bg-primary text-center">
                        <h1 class="text-white">Tubis Laundry</h1>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="true"><b>Staff Register</b></a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <form class="my-3" method="POST" action="">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nama" name="nama" required="true" aria-describedby="namaRegisterHelp" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="username" name="username" required="true" aria-describedby="usernameRegisterHelp" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password" name="password" required="true" aria-describedby="passwordRegisterHelp" placeholder="Password">
                                    </div>
                                    <?php if (isset($validation)) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= $validation->listErrors() ?>
                                        </div>
                                    <?php endif; ?>
                                    <input type="submit" class="btn btn-primary btn-block text-uppercase" value="Register"></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>