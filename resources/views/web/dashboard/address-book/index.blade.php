<div>
    @extends('web.dashboard.app', ['page' => 'address-book'])
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}




     
        <div class="container my-4 mt-4">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Address Book</h4>
                    <!-- Button to trigger modal -->
                    <button type="button" class="btn bg-primary text-white btn-sm" data-bs-toggle="modal"
                        data-bs-target="#addAddressModal">
                        <i class="fas fa-plus"></i> Add New Address
                    </button>
                </div>
                <div class="card-body">
                    <!-- Loop through addresses -->
                    @foreach ($addresses as $address)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $address->full_name }} 
                                <span class="text-muted">({{ $address->label }})</span>
                            </h5>
                            <p class="card-text">
                                <strong>Phone:</strong> {{ $address->mobile_number }}<br>
                                <strong>Address:</strong> {{ $address->address }}, {{ $address->area }}<br>
                                @if ($address->landmark)
                                    <strong>Landmark:</strong> {{ $address->landmark }}
                                @endif
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if ($address->is_default_delivery)
                                        <span class="badge bg-success">DEFAULT DELIVERY ADDRESS</span>
                                    @endif
                                    @if ($address->is_default_billing)
                                        <span class="badge bg-info">DEFAULT BILLING ADDRESS</span>
                                    @endif
                                </div>
                                <div class="btn-group" role="group" aria-label="Address Actions">
                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editAddressModal" data-address-id="{{ $address->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                    
                                    <!-- Delete Button -->
                                    <form action="{{ route('dashboard.address-book.delete-address', $address->id) }}"
                                        method="POST" class="ms-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                    <!-- Additional address entries can be added similarly -->
                </div>
            </div>
        </div>


        {{-- all eror --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Please check the form below for errors
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Add Address Modal -->

        <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="addAddressModalLabel">Add New Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="addAddressModalBody">
                        <form method="POST" action="{{ route('dashboard.address-book.new-address.store') }}">
                            @csrf
                        
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="fullName" class="form-label">Full Name</label>
                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="fullName" name="full_name" placeholder="Input full name" required>
                                    @error('full_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                        
                                <div class="col-md-6">
                                    <label for="mobileNumber" class="form-label">Mobile Number</label>
                                    <input type="tel" class="form-control @error('mobile_number') is-invalid @enderror" id="mobileNumber" name="mobile_number" placeholder="Input mobile number" required>
                                    @error('mobile_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                               
                        
                                <div class="col-md-6">
                                    <label for="area" class="form-label">Area</label>
                                    <select class="form-select @error('area') is-invalid @enderror" id="area" name="area" required>
                                        <option selected disabled>Please choose your area</option>
                                        <option value="Dhaka">Dhaka</option>
                                        <option value="Chattogram">Chattogram</option>
                                        <option value="Rajshahi">Rajshahi</option>
                                        <option value="Khulna">Khulna</option>
                                        <option value="Barishal">Barishal</option>
                                        <option value="Sylhet">Sylhet</option>
                                        <option value="Rangpur">Rangpur</option>
                                        <option value="Mymensingh">Mymensingh</option>
                                        
                                    </select>
                                    @error('area')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="House no. / building / street / area" required>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                        
                            </div>
                        
                            {{-- <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="area" class="form-label">Area</label>
                                    <select class="form-select @error('area') is-invalid @enderror" id="area" name="area" required>
                                        <option selected disabled>Please choose your area</option>
                                        <!-- Add area options here -->
                                    </select>
                                    @error('area')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                        
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="House no. / building / street / area" required>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div> --}}
                        
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="landmark" class="form-label">Landmark (Optional)</label>
                                    <input type="text" class="form-control @error('landmark') is-invalid @enderror" id="landmark" name="landmark" placeholder="E.g. beside train station">
                                    @error('landmark')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Select a label for effective delivery:</label>
                                    <div class="form-check">
                                        <input class="form-check-input @error('label') is-invalid @enderror" type="radio" name="label" id="homeLabel" value="Home" required>
                                        <label class="form-check-label" for="homeLabel">Home</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('label') is-invalid @enderror" type="radio" name="label" id="officeLabel" value="Office" required>
                                        <label class="form-check-label" for="officeLabel">Office</label>
                                    </div>
                                    @error('label')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                        
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Default Address (Optional)</label>
                                    <div class="form-check">
                                        <input class="form-check-input @error('is_default_delivery') is-invalid @enderror" type="checkbox" id="defaultDelivery" name="is_default_delivery" value="1">
                                        <label class="form-check-label" for="defaultDelivery">Default delivery address</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('is_default_billing') is-invalid @enderror" type="checkbox" id="defaultBilling" name="is_default_billing" value="1">
                                        <label class="form-check-label" for="defaultBilling">Default billing address</label>
                                    </div>
                                    @error('is_default_delivery')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @error('is_default_billing')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Your existing default address setting will be replaced if you make some changes here.
                                    </small>
                                </div>
                            </div>
                            
                        
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Save Address</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>


       
      

        <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="editAddressModalLabel">Edit Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editAddressForm" method="POST" action="{{ route('dashboard.address-book.edit-address.update') }}">

                            @csrf
                            @method('PATCH')

                            <!-- Hidden input for address ID -->
                            <input type="hidden" id="editAddressId" name="id">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="editFullName" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="name" id="editFullName"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="editMobileNumber" class="form-label">Mobile Number</label>
                                    <input type="tel" name="mobile_number" class="form-control"
                                        id="editMobileNumber" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="editArea" class="form-label">Area</label>
                                    <select class="form-select" id="editArea" name="area" required>
                                        <option value="">Choose...</option>
                                        <!-- Options will be populated dynamically -->
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="editAddress" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" id="editAddress" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="editLandmark" class="form-label">Landmark (Optional)</label>
                                    <input type="text" class="form-control" id="editLandmark" name="landmark">
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Select a label for effective delivery:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="label" id="editHomeLabel" value="Home">
                                        <label class="form-check-label" for="editHomeLabel">Home</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="label" id="editOfficeLabel" value="Office">
                                        <label class="form-check-label" for="editOfficeLabel">Office</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Select a label for effective delivery:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="label" id="editHomeLabel" value="Home">
                                        <label class="form-check-label" for="editHomeLabel">Home</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="label" id="editOfficeLabel" value="Office">
                                        <label class="form-check-label" for="editOfficeLabel">Office</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Default Address (Optional)</label>
                                    <div class="form-check">
                                        <input class="form-check-input" name="is_default_delivery" type="checkbox"
                                            id="editDefaultDelivery" value="1">
                                        <label class="form-check-label" for="editDefaultDelivery">Default delivery
                                            address</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="is_default_billing" type="checkbox"
                                            id="editDefaultBilling" value="1">
                                        <label class="form-check-label" for="editDefaultBilling">Default billing
                                            address</label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Your existing default address setting will be replaced if you make some changes
                                        here.
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>

@section('js')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    var editAddressModal = document.getElementById('editAddressModal');

    editAddressModal.addEventListener('show.bs.modal', async function(event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var addressId = button.getAttribute('data-address-id');

        // Ensure addressId is valid
        if (!addressId) {
            console.error('Address ID is not defined.');
            return;
        }

     

        try {
            // Fetch address details using Axios with async/await
            const response = await axios.get(
                `{{ route('dashboard.address-book.addresses.show', ':id') }}`.replace(':id', addressId)
            );
            const data = response.data;

// // Populate the form with fetched data
// document.getElementById('editAddressId').value = data.id;
// document.getElementById('editFullName').value = data.full_name;
// document.getElementById('editMobileNumber').value = data.mobile_number;
// document.getElementById('editAddress').value = data.address;
// document.getElementById('editLandmark').value = data.landmark;


document.getElementById('editAddressId').value = data.id;
document.getElementById('editFullName').value = data.full_name;
document.getElementById('editMobileNumber').value = data.mobile_number;
document.getElementById('editAddress').value = data.address;
document.getElementById('editLandmark').value = data.landmark;

console.log('Fetched label:', data.label.trim());



var areaSelect = document.getElementById('editArea');
if (areaSelect) {
    areaSelect.innerHTML = '<option value="">Choose...</option>';
    const areas = ['Dhaka', 'Chattogram', 'Rajshahi', 'Khulna', 'Barishal', 'Sylhet', 'Rangpur', 'Mymensingh'];
    areas.forEach(area => {
        var option = document.createElement('option');
        option.value = area;
        option.textContent = area;
        areaSelect.appendChild(option);
    });
    areaSelect.value = data.area || '';
}

document.getElementById('editDefaultDelivery').checked = data.is_default_delivery === 1;
document.getElementById('editDefaultBilling').checked = data.is_default_billing === 1;

if (data.label.trim() === 'Home') {
    document.getElementById('editHomeLabel').checked = true;
} else if (data.label.trim() === 'Office') {
    document.getElementById('editOfficeLabel').checked = true;
}


        } catch (error) {
            console.error('Error fetching address details:', error);
        }
    });
});

    </script>
@endsection