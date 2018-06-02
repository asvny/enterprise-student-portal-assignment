<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 col-lg-6 offset-lg-3">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Access limited</h4>
                <p>This function is available for authorized users only.</p>
                <hr>
                <p class="mb-0">You must log in first before using.</p>
            </div>

            <div class="jumbotron" style="padding: 2rem">
                <form action="index.php" method="POST" >
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="captcha">Captcha</label>
                        <div class="mb-2">
                            <img src="captcha/index.php" alt="">
                        </div>
                        <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Enter Captcha">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mt-4 py-2">Login</button>
                </form>
                <div class="alert alert-warning mt-3" role="alert">
                    <strong>For guest access:</strong> username/password is guest/SIT780
                </div>
            </div>
        </div>
    </div>
</div>