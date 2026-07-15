<x-layout-app page-title="Edit RH User" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Edit Human Resources Colaborator</h3>

        <hr>

        <form action="{{ route('adm.all-colaborators.updated-all-colaborators') }}" method="post">

            @csrf

            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-gl-2 row-cols-xl-2">
                    <div class="class="col col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="border {{ $conf['color-border'] }} p-2 h-100">
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-gl-2 row-cols-xl-2">
                            
                                {{-- Name --}}
                                <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $colaborator->name) }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                {{-- CPF --}}
                                <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf', $colaborator->document) }}">
                                        @error('cpf')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                {{-- Email --}}
                                <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $colaborator->email) }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                {{-- Phone --}}
                                <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $colaborator->detail->phone) }}">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                {{-- Password --}}
                                <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" value="{{ old('new_password') }}">
                                        @error('new_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                {{-- new_password_confirmation --}}
                                <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <label for="new_password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}">
                                        @error('new_password_confirmation')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                {{-- Department --}}
                                <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3 pe-3">
                                        <label for="select_department">Department</label>
                                        <select class="form-select" id="select_department" name="select_department">
                                            <option>Selecione um departamento</option>
                                            @foreach ($departments as $department)
                                            @if ($department->id == $colaborator->department_id)
                                            <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                                            @else
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endif)
                                            
                                            @endforeach
                                        </select>
                                        @error('select_department')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                {{-- Human Resources --}}
                                <div class="col col-sm-12 col-md-12 col-lg-12 col-xl-12 p-2">
                                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-gl-1 row-cols-xl-1">
                                        <div class="col col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <p class="mb-3">Profile: <strong>Human Resources</strong></p>
                                        </div>
                                    {{-- access --}}
                                    <div class="col col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="border {{ $conf['color-border'] }} p-2">
                                            <div class="mb-3">
                                                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-gl-4 row-cols-xl-4 btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                                    @foreach ($access as $aces)
                                                    
                                                    @if ($aces->short_name == $colaborator->permissions)
                                                        <div class="col col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-1 p-1">
                                                            <input type="checkbox" class="btn-check" name="permicao[]" value="{{ $aces->short_name }}" id="{{ $aces->name }}" checked>
                                                            <label class="btn btn-sm btn-outline-success" for="{{ $aces->name }}">{{ $aces->name }}</label>
                                                        </div>
                                                    @else
                                                        <div class="col col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-1 p-1">
                                                            <input type="checkbox" class="btn-check" name="permicao[]" value="{{ $aces->short_name }}" id="{{ $aces->name }}">
                                                            <label class="btn btn-sm btn-outline-success" for="{{ $aces->name }}">{{ $aces->name }}</label>
                                                        </div>
                                                    
                                                    @endif
                                                        
                                                    @endforeach
                                                    @error('permicao')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        {{-- user --}}
                       
                    </div>

                    {{-- user details --}}
                    <div class="col col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="col border {{ $conf['color-border'] }} p-2 h-100">
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-gl-2 row-cols-xl-2">
                                
                                {{-- Zip Code --}}
                                <div class="col col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                    <div class="mb-3">
                                        <label for="zip_code" class="form-label">Zip Code</label>
                                        <input type="text" class="form-control" id="cep" name="zip_code" value="{{ old('zip_code', $colaborator->detail->zip_code) }}">
                                        @error('zip_code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                {{-- Address --}}
                                <div class="col col-sm-12 col-md-8 col-lg-9 col-xl-9">
                                    <div class="mb-3">
                                        <label for="Address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="rua" name="address" value="{{ old('address', $colaborator->detail->address) }}">
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                {{-- Number --}}
                                <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-4">
                                        <label for="number" class="form-label">Number</label>
                                        <input type="text" class="form-control" id="number" name="number" value="{{ old('number', $colaborator->detail->number) }}">
                                        @error('number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                {{-- Complement --}}
                                <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <label for="complement" class="form-label">Complement</label>
                                        <input type="text" class="form-control" id="complement" name="complement" value="{{ old('complement', $colaborator->detail->complement) }}">
                                        @error('complement')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                {{-- neighborhood --}}
                                <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <label for="neighborhood" class="form-label">neighborhood</label>
                                        <input type="text" class="form-control" id="bairro" name="neighborhood" value="{{ old('neighborhood', $colaborator->detail->neighborhood) }}">
                                        @error('neighborhood')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- City --}}
                                <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="cidade" name="city" value="{{ old('city', $colaborator->detail->city) }}">
                                        @error('city')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                {{-- Salary --}}
                                <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <label for="salary" class="form-label">Salary</label>
                                        <input type="number" class="form-control" id="salary" name="salary" step=".01" placeholder="0,00" value="{{ old('salary', $colaborator->detail->salary) }}">
                                        @error('salary')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                 {{--  --}}
                                 <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
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
                    

                </div>

                    


                </div>

                <div class="d-flex justify-content-center">
                    <input type="hidden" name="user_id" value="{{ $colaborator->id }}">
                    <div class="mt-3">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('adm.all-colaborators.table-all-colaborators') }}" class="btn btn-outline-warning mb-4 me-3">Cancel</a>
                            <button type="submit" class="btn btn-outline-primary mb-4">Edit colaborator</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>

</x-layout-app>

