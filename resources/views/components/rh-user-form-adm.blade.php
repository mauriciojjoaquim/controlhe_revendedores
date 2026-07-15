<form action="{{ route('colaborators.rh.update-rh-user') }}" method="post">

    @csrf

    <div class="container-fluid">
        <div class="row gap-3">

            {{-- user --}}
            <div class="col border {{ $conf['color-border'] }} p-4">

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $colaborator->name) }}" readonly>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $colaborator->email) }}" readonly>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="d-flex">
                        <div class="flex row-1 pe-3">
                            <label for="select_department">Department</label>
                            <select class="form-select" id="select_department" name="select_department">
                                @foreach ($departments as $department)
                                @if ($department->id !== 1)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endif
                                    
                                @endforeach
                            </select>
                            @error('select_department')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <a href="{{ route('departments.new-department') }}"
                                class="btn btn-outline-primary mt-4" disabled><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>

                <p class="mb-3">Profile: <strong>Human Resources</strong></p>

            </div>

            {{-- user details --}}
            <div class="col border {{ $conf['color-border'] }} p-4">

                

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="zip_code" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" id="cep" name="zip_code" value="{{ old('zip_code', $colaborator->detail->zip_code) }}" readonly>
                            @error('zip_code')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="Address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="rua" name="address" value="{{ old('address', $colaborator->detail->address) }}" readonly>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="cidade" name="city" value="{{ old('city', $colaborator->detail->city) }}" readonly>
                            @error('city')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $colaborator->detail->phone) }}" readonly>
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="number" class="form-control" id="salary" name="salary" step=".01" placeholder="0,00" value="{{ old('salary', $colaborator->detail->salary) }}">
                            @error('salary')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="admission_date" class="form-label">Admission Date</label>
                            <input type="text" class="form-control" id="admission_date" name="admission_date" placeholder="YYYY-mm-dd" value="{{ old('admission_date', $colaborator->detail->admission_date) }}">
                            @error('admission_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="bairro" id="bairro">
        <input type="hidden" name="tipo" id="tipo" value="adm">
        <input type="hidden" name="user_id" id="user_id" value="{{ $colaborator->id }}">
        <div class="mt-3">
            <a href="{{ route('colaborators.rh.colaborators') }}" class="btn btn-outline-warning me-3">Cancel</a>
            <button type="submit" class="btn btn-primary">Updated colaborator</button>
        </div>

    </div>

</form>