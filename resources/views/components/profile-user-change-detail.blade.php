    <div class="border p-2 shadow-sm">
        <form action="{{ route('user.profile.update-user-detail') }}" method="post">

            @csrf
            <h3>User detail</h3>
                            <div class="mb-3">
                                <label for="zip_code" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="cep" name="zip_code" value="{{ old('zip_code', $colaborator->zip_code) }}">
                                @error('zip_code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="Address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="rua" name="address" value="{{ old('address', $colaborator->address) }}">
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="cidade" name="city" value="{{ old('city', $colaborator->city) }}">
                                @error('city')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $colaborator->phone) }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

            <input type="hidden" name="bairro" id="bairro">
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            <div class="mt-3 text-center">
                <button type="submit" class="btn btn-primary">Updated detail</button>
            </div>
        </form>
        @if (session('success_change_detail'))
        <div class="alert alert-success mt-3">
            {{ session('success_change_detail') }}
        </div>
        @endif
    </div>
