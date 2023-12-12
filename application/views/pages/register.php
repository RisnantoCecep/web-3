<div class="container pt-3 pb-6 mt-5 mb-5 ">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12 col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                           <div class="p-5">
                                <div class="text-center">
                                    <h1 class="mb-4">Registration</h1>
                                </div>
                                <?php if($this->session->flashdata('warning')): ?>
                                    <div class="alert alert-warning"><?= $this->session->flashdata('warning') ?></div>
                                <?php endif ?>
                                <form class="user" method= "post" action="register/registrasi">
                                    <div class="form-group mb-3">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control form-control-user" id="exampleInputName" aria-describedby="nameHelp" placeholder="your name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">E-mail Addres</label>
                                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="your email">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone" class="form-control form-control-user" id="exampleInputPhone" aria-describedby="phoneHelp" placeholder="please input">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" aria-describedby="passwordHelp" placeholder="please input">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="">Password Confirm</label>
                                        <input type="password" name="password2" class="form-control form-control-user" id="exampleInputPassword" aria-describedby="passwordHelp" placeholder="confirm Password">
                                    </div>
                                    <div class="custom-text small p-0 mt-0 float-sm-end">
                                        <p class="custom-text small"><span class="text-danger">*</span> do you have an account?<a href="<?= base_url('login')?>">Login</a></p>
                                    </div>

                                    <button type="submit" class="btn btn-danger btn-user btn-block col-12 mt-4 ">Submit</button>
                                </form>
                           </div> 
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>