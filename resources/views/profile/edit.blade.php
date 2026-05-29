@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
<div class="row">
    <div class="col-md-8">

        {{-- Update Profile Info --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-edit mr-2"></i>Profile Information</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', Auth::user()->name) }}" required>
                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email', Auth::user()->email) }}" required>
                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Save Changes
                    </button>
                    @if(session('status') === 'profile-updated')
                        <span class="text-success ml-2"><i class="fas fa-check"></i> Saved!</span>
                    @endif
                </form>
            </div>
        </div>

        {{-- Change Password --}}
        <div class="card card-warning" id="update-password-form">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-key mr-2"></i>Change Password</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                        @error('current_password')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-key mr-1"></i> Update Password
                    </button>
                    @if(session('status') === 'password-updated')
                        <span class="text-success ml-2"><i class="fas fa-check"></i> Updated!</span>
                    @endif
                </form>
            </div>
        </div>

        {{-- Delete Account --}}
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-trash mr-2"></i>Delete Account</h3>
            </div>
            <div class="card-body">
                <p class="text-muted">Once deleted, all data will be permanently removed.</p>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                    <i class="fas fa-trash mr-1"></i> Delete My Account
                </button>
            </div>
        </div>

    </div>

    <div class="col-md-4">
        {{-- Profile Card --}}
        <div class="card">
            <div class="card-body text-center">
                <div style="width:80px;height:80px;background:linear-gradient(135deg,#2e7d8c,#1a5f6e);
                            border-radius:50%;display:flex;align-items:center;justify-content:center;
                            color:white;font-weight:700;font-size:2rem;margin:0 auto 16px;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <h5 style="color:#1e2a3a;font-weight:600">{{ Auth::user()->name }}</h5>
                <p class="text-muted">{{ Auth::user()->email }}</p>
                <hr>
                <div class="text-left">
                    <small class="text-muted">Member since</small>
                    <p style="color:#1e2a3a;font-weight:500">
                        {{ Auth::user()->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:12px">
            <div class="modal-header border-0">
                <h5 class="modal-title text-danger"><i class="fas fa-exclamation-triangle mr-2"></i>Delete Account</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure? This action <strong>cannot be undone</strong>.</p>
                <form method="POST" action="{{ route('profile.destroy') }}" id="deleteForm">
                    @csrf @method('DELETE')
                    <div class="form-group">
                        <label>Enter your password to confirm</label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password', 'userDeletion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" form="deleteForm" class="btn btn-danger">
                    <i class="fas fa-trash mr-1"></i> Delete Account
                </button>
            </div>
        </div>
    </div>
</div>
@endsection