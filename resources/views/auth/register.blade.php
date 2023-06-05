<x-guest-layout>
    <form class="row g-3 needs-validation" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="col-12">
            <label for="yourEmail" class="form-label">Username</label>
            <div class="input-group has-validation">
                <input type="text" name="name" class="form-control" id="yourEmail" required>
                <div class="invalid-feedback">Please enter your username.</div>
            </div>
        </div>

        <div class="col-12">
            <label for="yourEmail" class="form-label">Email Address</label>
            <div class="input-group has-validation">
                <input type="email" name="email" class="form-control" id="yourEmail" required>
                <div class="invalid-feedback">Please enter your email.</div>
            </div>
        </div>

        <div class="col-12">
            <label for="yourPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="yourPassword" required>
            <div class="invalid-feedback">Please enter your password!</div>
        </div>

        <div class="col-12">
            <label for="yourPassword" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="yourPassword" required>
            <div class="invalid-feedback">Please enter your password confirmation!</div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Register</button>
        </div>
        <div class="col-12">
            <p class="small mb-0">Already have account? <a href="{{route('login')}}">Login account</a></p>
        </div>
    </form>
</x-guest-layout>
