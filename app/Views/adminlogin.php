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
                                <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true"><b>Staff Sign-In</b></a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                <?php if (session()->get('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->get('success') ?>
                                </div>
                                <?php endif; ?>
                                <form class="my-3" method="POST" action="">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="username" id="username" required="true" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" id="password" required="true" placeholder="Password">
                                    </div>
                                    <?php if (isset($validation)) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $validation->listErrors() ?>
                                    </div>
                                    <?php endif; ?>
                                    <input type="submit" class="btn btn-primary btn-block font-weight-bold" name="buttonLogin" value="Login">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>