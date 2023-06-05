<x-guest-layout>
    <form class="row g-3 needs-validation" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="col-12">
            <label for="yourEmail" class="form-label">Email Address</label>
            <div class="input-group has-validation">
                <input type="text" name="email" class="form-control" id="yourEmail">
                <div class="invalid-feedback">Please enter your email.</div>
            </div>
        </div>

        <div class="col-12">
            <label for="yourPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="yourPassword" required>
            <div class="invalid-feedback">Please enter your password!</div>
        </div>

        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Login</button>
        </div>
        <div class="col-12">
            <p class="small mb-0">Don't have account? <a href="{{route('register')}}">Create an account</a></p>
        </div>
    </form>
</x-guest-layout>
