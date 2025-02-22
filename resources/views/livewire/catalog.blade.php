<div>
    <div class="row m-0">
        @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="width:500px">
            {{ session('message') }}
            <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close" style=" font-size: 0.75rem;padding: 0.25rem 0.5rem;margin-top:5px"></button>
        </div>
        @endif

        <div class="col-md-12 mb-4">
            <button style="background-color: rgb(2, 17, 79); color: white; border-radius: 5px; margin: 0; padding: 1px 0; font-size: 12px;width:80px;height:40px;" onclick="location.href='/HelpDesk'">
                Back
            </button>
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="filter-container" style="display: flex; flex-direction: column;">
                    <h4 class="m-0 pb-3 " style="font-size: 16px;">Catalog Filters</h4>
                    <div style="display: flex;gap:10px;">
                        <p class="m-0 pb-2 pt-2 catalogFilter activeCatalog" id="infTech" onclick="changeSideMenu('infTech')" style="font-size: 12px; padding: 5px;color:#778899;">Information Technology</p>
                        <p class="m-0 pb-2 pt-2 catalogFilter" id="standChanges" onclick="changeSideMenu('standChanges')" style="font-size: 12px; padding: 5px;color:#778899;">Standard Changes</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="informationTech" class="col-12 mb-4 showIt">
            <div class="row m-0" style="background:white; border:1px solid grey; border-radius:5px;">
                <div class="row m-0">
                    <div class="col-6">
                        <h4 class="mb-4 mt-4" style="font-size: 16px;">Popular Items</h4>
                    </div>
                    <div class="col-6" style="text-align: right; margin: auto; font-size: 13px; padding-right: 15px;">
                        <i class="fas fa-table catalogCardIcon" id="catCardView" onclick="changeView('catCardView')" style="padding: 5px; border-radius: 50%; background-color: #f0f0f0; cursor: pointer; color: #333;align-items:center"></i>
                        <span style="border: 1px solid" class="me-3 ms-1"></span>
                        <i class="far fa-list-alt catalogCardIcon" id="catListView" onclick="changeView('catListView')" style="padding: 5px; border-radius: 50%; background-color: #f0f0f0; cursor: pointer; color: #333;"></i>
                    </div>
                </div>
                <section id="catalogCardView" class="showIt">
                    <div class="row m-0">

                        <div class="col-md-4 mb-4">
                            <div style="background:white;border:1px solid #d3d3d3;border-radius:5px; padding: 10px 15px;">
                                <p style="font-size: 12px;"><b>Add Members to Distribution List</b></p>
                                <div class="row m-0">
                                    <div class="col-12 text-center mb-2">
                                        <img src="https://snow.payg.in/89294c29871c7510279786a50cbb35b5.iix?t=medium" style="height:4em;">
                                    </div>
                                    <div class="col-12 mb-2" style="font-size:12px">
                                        <p style="text-decoration:underline;cursor: pointer; text-align: center;" wire:click="AddRequest" >Add Members to Distribution List</p>
                                    </div>
                                    @if($AddRequestaceessDialog)
    <div class="modal" tabindex="-1" role="dialog" style="{{ $showModal ? 'display: block;' : 'display: none;' }}">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Distribution List</h1>
                </div>
                <div class="modal-body">
                    <div class="row m-0">
                        <div class="col-4 m-auto">
                            <img src="https://snow.payg.in/89294c29871c7510279786a50cbb35b5.iix?t=medium" style="height:4em">
                        </div>
                        <div class="col-8 m-auto">
                            <p style="font-size:15px;">Use this Catalogue Item to raise New Request for Adding a New Distribution List</p>
                        </div>
                    </div>
                    <hr style="border: 1px solid #ccc; margin: 10px 0;">

                    <form wire:submit.prevent="DistributorRequest">
                        <div class="form-group mt-2">
                            <label for="distributor_name">Provide the Name of Distribution List<span style="color:red">*</span></label>
                            <input wire:model.lazy="distributor_name" wire:keydown.debounce.500ms="validateField('form.distributor_name')"  type="text" class="form-control" id="distributor_name">
                            @error('distributor_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="subject">Business Justification<span style="color:red">*</span></label>
                            <input   wire:model.lazy="subject" wire:keydown.debounce.500ms="validateField('form.subject')"  type="text" class="form-control" id="subject">
                            @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="description">Specific Information<span style="color:red">*</span></label>
                            <textarea wire:model.lazy="description" wire:keydown.debounce.500ms="validateField('form.description')" class="form-control" id="description"></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="row mt-2" style="margin-left: -10px;">
                            <div class="row">
                                <div class="form-group">
                                    <div class="form-group m-0 p-0">
                                        <label for="cc_to">Members to be Added: <span style="font-size:12px"> {{ implode(', ', array_unique($selectedPeopleNames)) }}</span></label>
                                        @if (session()->has('selecterror'))
    <div class="alert alert-danger">
        {{ session('selecterror') }}
    </div>
@endif
                                    </div>
                                </div>
                                <div class="form-group m-0">
                                    <div class="form-group p-0">
                                        <button type="button" class="btn btn" wire:click="NamesSearch" style="background-color: rgb(2, 17, 79); color: white;">
                                            <i class="fa fa-plus me-3"></i>
                                            Add
                                        </button>
                                    </div>
                                    @error('cc_to') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            @if($isNames)
                                <div style="border-radius:5px; background-color:grey; padding:8px; width:330px; margin-top:10px; height:200px; overflow-y:auto;">
                                    <div class="input-group4" style="display: flex; align-items: center; width: 100%;">
                                        <input wire:model="searchTerm" style="font-size: 10px; cursor: pointer; border-radius: 5px 0 0 5px; width: 250px; height: 30px; padding: 5px;" type="text" class="form-control" placeholder="Search for Emp.Name or ID" aria-label="Search" aria-describedby="basic-addon1">
                                        <div class="input-group-append" style="display: flex; align-items: center;">
                                            <button wire:click="filter" style="height: 30px; border-radius: 0 5px 5px 0; background-color: rgb(2, 17, 79); color: #fff; border: none; padding: 0 10px;" class="btn" type="button">
                                                <i style="text-align: center;" class="fa fa-search"></i>
                                            </button>

                                            <button wire:click="closePeoples" type="button" class="close rounded px-1 py-0" aria-label="Close" style="background-color: rgb(2,17,79); height: 30px; width: 30px; margin-left: 5px; display: flex; align-items: center; justify-content: center;">
                                                <span aria-hidden="true" style="color: white; font-size: 24px; line-height: 0;">×</span>
                                            </button>
                                        </div>
                                    </div>

                                    @if ($peopleData->isEmpty())
                                        <div class="container" style="text-align: center; color: white; font-size:12px">
                                            No People Found
                                        </div>
                                    @else
                                        @foreach($peopleData->sortBy(function($people) { return strtolower($people->first_name) . ' ' . strtolower($people->last_name); }) as $people)
                                            <label wire:click="selectPerson('{{ $people->emp_id }}')" class="container" style="cursor: pointer; background-color: darkgrey; padding: 5px; margin-top: 10px; width: 300px; border-radius: 5px;">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                    <input type="checkbox"   id="person-{{ $people->emp_id }}" class="form-check-input custom-checkbox-helpdesk" wire:model="selectedPeople" value="{{ $people->emp_id }}" {{ $people->isChecked ? 'checked' : '' }}>
                                                    </div>
                                                    <div class="col-auto">
                                                        @if (!empty($people->image) && $people->image !== 'null')
                                                            <img class="profile-image"  src="data:image/jpeg;base64,{{($people->image) }}">
                                                        @else
                                                            @php $gender = $people->gender ?? null; @endphp
                                                            @if ($gender === 'Male')
                                                                <img class="profile-image" src="{{ asset('images/male-default.png') }}" alt="Default Male Image">
                                                            @elseif($gender === 'Female')
                                                                <img class="profile-image" src="{{ asset('images/female-default.jpg') }}" alt="Default Female Image">
                                                            @else
                                                                <img class="profile-image" src="{{ asset('images/user.jpg') }}" alt="Default Image">
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="username" style="font-size: 12px; color: white;">{{ ucwords(strtolower($people->first_name)) }} {{ ucwords(strtolower($people->last_name)) }}</h6>
                                                        <p class="mb-0" style="font-size: 12px; color: white;">(#{{ $people->emp_id }})</p>
                                                    </div>
                                                </div>
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="fileInput" style="color:#778899; font-weight:500; font-size:12px; cursor:pointer;">
                                    <i class="fa fa-paperclip"></i> Attach Image
                                </label>
                            </div>
                            @error('file_path') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <input type="file" wire:model="file_path" id="file_path" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="m-0 p-0 mt-3 d-flex gap-3 justify-content-center">
                        <button type="button" wire:click="DistributorRequest" class="submit-btn">Submit</button>
                        <button wire:click="closecatalog" type="button" class="cancel-btn" style="border:1px solid rgb(2,17,79);">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show blurred-backdrop" style="{{ $showModal ? '' : 'display: none;' }}"></div>
@endif


                                </div>

                               
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;">
                                <p style="font-size: 12px;"><b>Request for IT Accessories</b></p>
                                <div class="row m-0">
                                    <div class="col-12 text-center mb-2">
                                        <img src="https://snow.payg.in/cc7c281087dc7150fc21ed7bbbbb356b.iix?t=medium" style="width: 4em; height:4em;">
                                    </div>
                                    <div class="col-12 mb-2" style="font-size:12px">
                                        <p style="text-decoration:underline;cursor: pointer; text-align: center;" wire:click="ItRequest">Request for IT Accessories</p>
                                    </div>
                                    @if($ItRequestaceessDialog)
                                    <div class="modal" tabindex="-1" role="dialog" style="{{ $showModal ? 'display: block;' : 'display: none;' }}">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Request for IT Accessories</h1>

                                                </div>

                                                <div class="modal-body">
                                                    <div class="row m-0">
                                                        <div class="col-4 m-auto">
                                                            <img src="https://milvusrobotics.com/assets/careers/support.b904d83a.png" style="height:7em">
                                                        </div>
                                                        <div class="col-8 m-auto">
                                                            <p style="font-size:14px;">
                                                                Please use this catalogue item to raise new request for IT accessories
                                                                like Headset, Mouse, Keyboard, Monitor etc.</p>
                                                        </div>
                                                    </div>
                                                    <hr style="border: 1px solid #ccc;margin: 10px 0;">
                                                    <form wire:submit.prevent="submit" >


                                                        <div class="form-group mt-2" >
                                                            <label for="selectedEquipment "   >Select Equipment<span style="color:red">*</span></label>
                                                            <select wire:model.lazy="selected_equipment" wire:keydown.debounce.500ms="validateField('selected_equipment')" class="form-control" style="font-size: 12px;">
                                                                <option value="keyboard">Select Equipment</option>
                                                                <option value="keyboard">Keyboard</option>
                                                                <option value="mouse">Mouse</option>
                                                                <option value="headset">Headset</option>
                                                                <option value="monitor">Monitor</option>
                                                            </select>

                                                            @error('selected_equipment')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                        <div class="form-group mt-2">
                                                            <label for="contactDetails">Business Justification<span style="color:red">*</span></label>
                                                            <input wire:model.lazy="subject"   wire:keydown.debounce.500ms="validateField('subject')" type="text" class="form-control">
                                                            @error('subject') <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="reason">Specific Information<span style="color:red">*</span></label>
                                                            <textarea wire:model="description"  wire:keydown.debounce.500ms="validateField('description')" class="form-control"></textarea>
                                                            @error('description') <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group ml-1"  style="margin-top:5px">
                                                            <div class="row">
                                                                <div class="form-group ">
                                                                    <label for="cc_to" class="form-label ">Request For : <span style="font-size:12px"> {{ implode(', ', array_unique($selectedPeopleNames)) }}</span></label>
                                                                    @if (session()->has('selecterror'))
    <div class="alert alert-danger">
        {{ session('selecterror') }}
    </div>
@endif
                                                                </div>
                                                                <div class="form-group ">
                                                                    <div class=" p-0">
                                                                        <button type="button" class="btn btn" wire:click="NamesSearch" style="background-color: rgb(2, 17, 79);color:white">
                                                                            <i class="fa fa-plus me-3"></i>
                                                                            Add
                                                                        </button>
                                                                    </div>

                                                                    @error('cc_to') <span class="text-danger" style="margin-left:20px">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            @if($isNames)
    <div style="border-radius:5px; background-color:grey; padding:8px; width:330px; margin-top:10px; height:200px; overflow-y:auto;">
    <div class="input-group5" style="display: flex; align-items: center; width: 100%;">
    <input 
        wire:model="searchTerm" 
        style="font-size: 10px; cursor: pointer; border-radius: 5px 0 0 5px; width: 250px; height: 30px; padding: 5px;" 
        type="text" 
        class="form-control" 
        placeholder="Search for Emp.Name or ID" 
        aria-label="Search" 
        aria-describedby="basic-addon1"  wire:input="autoValidate"
    >
    <div class="input-group-append" style="display: flex; align-items: center;">
        <button 
            wire:click="filter" 
            style="height: 30px; border-radius: 0 5px 5px 0; background-color: rgb(2, 17, 79); color: #fff; border: none; padding: 0 10px;" 
            class="btn" 
            type="button"
        >
            <i style="text-align: center;" class="fa fa-search"></i>
        </button>

        <button 
            wire:click="closePeoples"  
            type="button" 
            class="close rounded px-1 py-0" 
            aria-label="Close" 
            style="background-color: rgb(2,17,79); height: 30px; width: 30px; margin-left: 5px; display: flex; align-items: center; justify-content: center;"
        >
            <span aria-hidden="true" style="color: white; font-size: 24px; line-height: 0;">×</span>
        </button>
    </div>
</div>
        @if ($peopleData->isEmpty())
            <div class="container" style="text-align: center; color: white; font-size:12px">
                No People Found
            </div>
        @else
            @foreach($peopleData->sortBy(function($people) { return strtolower($people->first_name) . ' ' . strtolower($people->last_name); }) as $people)
                <label wire:click="selectPerson('{{ $people->emp_id }}')" class="container" style="cursor: pointer; background-color: darkgrey; padding: 5px; margin-top: 10px; width: 300px; border-radius: 5px;">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <input type="checkbox" class="form-check-input custom-checkbox-helpdesk"  id="person-{{ $people->emp_id }}" wire:model="selectedPeople" value="{{ $people->emp_id }}" {{ $people->isChecked ? 'checked' : '' }}>
                        </div>
                        <div class="col-auto">
                        @if (!empty($people->image) && $people->image !== 'null')
                        <!-- Display the actual image if available -->
                        <img class="profile-image"  src="data:image/jpeg;base64,{{($people->image) }}">
                    @else
                        <!-- If image is not available, check the gender and show default images -->

                            @php
                                // Debugging step to check gender
                                $gender = $people->gender ?? null;
                            @endphp
                            @if ($gender === 'Male')
                                <img class="profile-image" src="{{ asset('images/male-default.png') }}" alt="Default Male Image">
                            @elseif($gender === 'Female')
                                <img class="profile-image" src="{{ asset('images/female-default.jpg') }}" alt="Default Female Image">
                          
                        @else
                            <!-- Fallback if emp is not available -->
                            <img class="profile-image" src="{{ asset('images/user.jpg') }}" alt="Default Image">
                        @endif
                    @endif
                        </div>
                        <div class="col">
                            <h6 class="username" style="font-size: 12px; color: white;">{{ ucwords(strtolower($people->first_name)) }} {{ ucwords(strtolower($people->last_name)) }}</h6>
                            <p class="mb-0" style="font-size: 12px; color: white;">(#{{ $people->emp_id }})</p>
                        </div>
                    </div>
                </label>
            @endforeach
        @endif
    </div>
@endif

                                                        </div>
                                                        <div class="row mt-2">
                            <div class="col">
                                <label for="fileInput" style="color:#778899;font-weight:500;font-size:12px;cursor:pointer;">
                                    <i class="fa fa-paperclip"></i> Attach Image
                                </label>
                            </div>
                            @error('file_path') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div>
                        <input type="file" wire:model="file_path" id="file_path" class="form-control">

                        </div>

                                                    </form>
                                                </div>
                                                <div class="modal-footer justify-content-center" >
                                                           <div class="m-0 p-0 mt-3 d-flex gap-3 justify-content-center">
                                                           <button type="button" wire:click="submit" class="submit-btn">Submit</button>
                                                    <button wire:click="closecatalog" type="button" class="cancel-btn" style="border:1px solid rgb(2,17,79);">Cancel</button>


                                                           </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-backdrop fade show blurred-backdrop" style="{{ $showModal ? '' : 'display: none;' }}"></div>
                                    @endif

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;">
                                <p style="font-size: 12px;"><b>Add Members to Mailbox</b></p>
                                <div class="row m-0">
                                    <div class="col-12 text-center mb-2">
                                        <img src="https://snow.payg.in/c3d8c429871c7510279786a50cbb3564.iix?t=medium" style="height:4em;">
                                    </div>
                                    <div class="col-12 mb-2" style="font-size:12px">
                                        <p style="text-decoration:underline;cursor: pointer; text-align: center;" wire:click="MailRequest">Add Members to Mailbox</p>
                                    </div>
                                    @if($MailRequestaceessDialog)
                                    <div class="modal" tabindex="-1" role="dialog" style="{{ $showModal ? 'display: block;' : 'display: none;' }}">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Members to Mailbox</h1>

                                                </div>

                                                <div class="modal-body">
                                                    <div class="row m-0">
                                                        <div class="col-4 m-auto">
                                                            <img src="https://bookbird.io/wp-content/uploads/2022/06/Category-List-Icon-01.svg" style="height:7em">
                                                        </div>
                                                        <div class="col-8 m-auto">
                                                            <p style="font-size:15px;"> Use this Catalogue item to Add members to Mailbox</p>
                                                        </div>
                                                    </div>
                                                    <hr style="border: 1px solid #ccc;margin: 10px 0;">
                                                    <form wire:submit.prevent="Request">



                                                        <div class="form-group mt-2">
                                                            <label for="contactDetails">Provide the Name of Mailbox<span style="color:red">*</span></label>
                                                            <input wire:model.lazy="mail"  wire:keydown.debounce.500ms="validateField('mail')" type="text" class="form-control">
                                                            @error('mail') <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group mt-2">
                                                            <label for="contactDetails">Business Justification<span style="color:red">*</span></label>
                                                            <input wire:model.lazy="subject"  wire:keydown.debounce.500ms="validateField('subject')" type="text" class="form-control">
                                                            @error('subject') <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="reason">Specific Information<span style="color:red">*</span></label>
                                                            <textarea wire:model.lazy="description"  wire:keydown.debounce.500ms="validateField('description')" class="form-control"></textarea>
                                                            @error('description') <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                            <div class="form-group ">
                                                                <div class="form-group ">
                                                                    <label for="cc_to" class="form-label" >Add users to be a New Mailbox : <span style="font-size:12px"> {{ implode(', ', array_unique($selectedPeopleNames)) }}</span></label>

                                                                </div>
                                                                <div class="form-group ">
                                                                    <div class="form-group  ">
                                                                        <button type="button" class="btn btn" wire:click="NamesSearch" style="background-color: rgb(2, 17, 79);color:white">
                                                                            <i class="fa fa-plus me-3"></i>
                                                                            Add
                                                                        </button>
                                                                    </div>

                                                                    @error('cc_to') <span class="text-danger" style="margin-left:20px">{{ $message }}</span> @enderror
                                                                </div>

                                                            @if($isNames)
    <div style="border-radius:5px; background-color:grey; padding:8px; width:330px; margin-top:10px; height:200px; overflow-y:auto;">
    <div class="input-group5" style="display: flex; align-items: center; width: 100%;">
    <input 
        wire:model="searchTerm" 
        style="font-size: 10px; cursor: pointer; border-radius: 5px 0 0 5px; width: 250px; height: 30px; padding: 5px;" 
        type="text" 
        class="form-control" 
        placeholder="Search for Emp.Name or ID" 
        aria-label="Search" 
        aria-describedby="basic-addon1"
    >
    <div class="input-group-append" style="display: flex; align-items: center;">
        <button 
            wire:click="filter" 
            style="height: 30px; border-radius: 0 5px 5px 0; background-color: rgb(2, 17, 79); color: #fff; border: none; padding: 0 10px;" 
            class="btn" 
            type="button"
        >
            <i style="text-align: center;" class="fa fa-search"></i>
        </button>

        <button 
            wire:click="closePeoples"  
            type="button" 
            class="close rounded px-1 py-0" 
            aria-label="Close" 
            style="background-color: rgb(2,17,79); height: 30px; width: 30px; margin-left: 5px; display: flex; align-items: center; justify-content: center;"
        >
            <span aria-hidden="true" style="color: white; font-size: 24px; line-height: 0;">×</span>
        </button>
    </div>
</div>
        @if ($peopleData->isEmpty())
            <div class="container" style="text-align: center; color: white; font-size:12px">
                No People Found
            </div>
        @else
            @foreach($peopleData->sortBy(function($people) { return strtolower($people->first_name) . ' ' . strtolower($people->last_name); }) as $people)
                <label wire:click="selectPerson('{{ $people->emp_id }}')" class="container" style="cursor: pointer; background-color: darkgrey; padding: 5px; margin-top: 10px; width: 300px; border-radius: 5px;">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <input type="checkbox"  class="form-check-input custom-checkbox-helpdesk" id="person-{{ $people->emp_id }}" wire:model="selectedPeople" value="{{ $people->emp_id }}" {{ $people->isChecked ? 'checked' : '' }}>
                        </div>
                        <div class="col-auto">
                        @if (!empty($people->image) && $people->image !== 'null')
                        <!-- Display the actual image if available -->
                        <img class="profile-image"  src="data:image/jpeg;base64,{{($people->image) }}">
                    @else
                        <!-- If image is not available, check the gender and show default images -->

                            @php
                                // Debugging step to check gender
                                $gender = $people->gender ?? null;
                            @endphp
                            @if ($gender === 'Male')
                                <img class="profile-image" src="{{ asset('images/male-default.png') }}" alt="Default Male Image">
                            @elseif($gender === 'Female')
                                <img class="profile-image" src="{{ asset('images/female-default.jpg') }}" alt="Default Female Image">
                          
                        @else
                            <!-- Fallback if emp is not available -->
                            <img class="profile-image" src="{{ asset('images/user.jpg') }}" alt="Default Image">
                        @endif
                    @endif
                        </div>
                        <div class="col">
                            <h6 class="username" style="font-size: 12px; color: white;">{{ ucwords(strtolower($people->first_name)) }} {{ ucwords(strtolower($people->last_name)) }}</h6>
                            <p class="mb-0" style="font-size: 12px; color: white;">(#{{ $people->emp_id }})</p>
                        </div>
                    </div>
                </label>
            @endforeach
        @endif
    </div>
@endif

                                                        </div>
                                                        <div class="row mt-2">
                            <div class="col">
                                <label for="fileInput" style="color:#778899;font-weight:500;font-size:12px;cursor:pointer;">
                                    <i class="fa fa-paperclip"></i> Attach Image
                                </label>
                            </div>
                            @error('file_path') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div>
                        <input type="file" wire:model="file_path" id="file_path" class="form-control">

                        </div>

                                                    </form>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                <div class="m-0 p-0 mt-3 d-flex gap-3 justify-content-center">

<button type="button" wire:click="Request" class="submit-btn">Submit</button>
                                                    <button wire:click="closecatalog" type="button" class="cancel-btn" style="border:1px solid rgb(2,17,79);">Cancel</button>
</div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-backdrop fade show blurred-backdrop" style="{{ $showModal ? '' : 'display: none;' }}"></div>
                                    @endif

                                </div>
                     
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-md-4 mb-4">
                                <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;">
                                    <p style="font-size: 12px;"><b>ID Card Request</b></p>
                                    <div class="row m-0">
                                        <div class="col-12 text-center mb-2">
                                            <img src="https://snow.payg.in/673ac469871c7510279786a50cbb3563.iix?t=medium" style="height:4em;">
                                        </div>
                                        <div class="col-12 mb-2" style="font-size:12px">
                                            <p style="text-decoration:underline;cursor: pointer; text-align: center;" wire:click="IdRequest">New ID Card Request</p>
                                        </div>
                                        @if($IdRequestaceessDialog)
                                        <div class="modal" tabindex="-1" role="dialog" style="{{ $showModal ? 'display: block;' : 'display: none;' }}">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">ID Card Request</h1>

                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row m-0">
                                                            <div class="col-4 m-auto">
                                                                <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQjGjkjvPfFt0_8-8s0JpLbQ4cDn7Jc_Oz2grDb09ZeXPm9oqJ8" style="height:7em">
                                                            </div>
                                                            <div class="col-8 m-auto">
                                                                <p style="font-size:15px;">New ID Card Request</p>
                                                            </div>
                                                        </div>
                                                        <hr style="border: 1px solid #ccc;margin: 10px 0;">
                                                        <form wire:submit.prevent="Devops">



                                                            <div style="display:flex">
                                                           
    <div class="form-group col-md-6 mt-2">
        <label for="contactDetails">Mobile Number<span style="color:red">*</span></label>
        <input wire:model="mobile"  wire:keydown.debounce.500ms="validateField('mobile')" type="text" class="form-control">
        @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group col-md-6 mt-2" style="margin-left:5px">
        <label for="contactDetails">Email<span style="color:red">*</span></label>
        <input wire:model="mail"  wire:keydown.debounce.500ms="validateField('mail')" type="text" class="form-control">
        @error('mail') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label for="contactDetails">Business Justification<span  style="color:red">*</span></label>
                                                                <input wire:model="subject"  wire:keydown.debounce.500ms="validateField('subject')" type="text" class="form-control">
                                                                @error('subject') <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label for="reason">Specific Information<span  style="color:red">*</span></label>
                                                                <textarea wire:model="description"  wire:keydown.debounce.500ms="validateField('description')" class="form-control"></textarea>
                                                                @error('description') <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="row ml-1">
                                                                    <div class="form-group mb-1">
                                                                        <label for="cc_to" class="form-label"> Request For :<span style="font-size:12px"> {{ implode(', ', array_unique($selectedPeopleNames)) }}</span></label>
                                                                        @if (session()->has('selecterror'))
    <div class="alert alert-danger">
        {{ session('selecterror') }}
    </div>
@endif
                                                                    </div>
                                                                    <div class="row m-0">
                                                                        <div class="form-group  p-0">
                                                                            <button type="button" class="btn btn" wire:click="NamesSearch" style="background-color: rgb(2, 17, 79);color:white">
                                                                                <i class="fa fa-plus me-3"></i>
                                                                                Add
                                                                            </button>
                                                                        </div>

                                                                        @error('cc_to') <span class="text-danger" style="margin-left:20px">{{ $message }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                                @if($isNames)
    <div style="border-radius:5px; background-color:grey; padding:8px; width:330px; margin-top:10px; height:200px; overflow-y:auto;margin-left:10px">
    <div class="input-group6" style="display: flex; align-items: center; width: 100%;">
    <input 
        wire:model="searchTerm" 
        style="font-size: 10px; cursor: pointer; border-radius: 5px 0 0 5px; width: 250px; height: 30px; padding: 5px;" 
        type="text" 
        class="form-control" 
        placeholder="Search for Emp.Name or ID" 
        aria-label="Search" 
        aria-describedby="basic-addon1"
    >
    <div class="input-group-append" style="display: flex; align-items: center;">
        <button 
            wire:click="filter" 
            style="height: 30px; border-radius: 0 5px 5px 0; background-color: rgb(2, 17, 79); color: #fff; border: none; padding: 0 10px;" 
            class="btn" 
            type="button"
        >
            <i style="text-align: center;" class="fa fa-search"></i>
        </button>

        <button 
            wire:click="closePeoples"  
            type="button" 
            class="close rounded px-1 py-0" 
            aria-label="Close" 
            style="background-color: rgb(2,17,79); height: 30px; width: 30px; margin-left: 5px; display: flex; align-items: center; justify-content: center;"
        >
            <span aria-hidden="true" style="color: white; font-size: 24px; line-height: 0;">×</span>
        </button>
    </div>
</div>
        @if ($peopleData->isEmpty())
            <div class="container" style="text-align: center; color: white; font-size:12px">
                No People Found
            </div>
        @else
            @foreach($peopleData->sortBy(function($people) { return strtolower($people->first_name) . ' ' . strtolower($people->last_name); }) as $people)
                <label wire:click="selectPerson('{{ $people->emp_id }}')" class="container" style="cursor: pointer; background-color: darkgrey; padding: 5px; margin-top: 10px; width: 300px; border-radius: 5px;">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <input type="checkbox"  class="form-check-input custom-checkbox-helpdesk" id="person-{{ $people->emp_id }}" wire:model="selectedPeople" value="{{ $people->emp_id }}" {{ $people->isChecked ? 'checked' : '' }}>
                        </div>
                        <div class="col-auto">
                        @if (!empty($people->image) && $people->image !== 'null')
                        <!-- Display the actual image if available -->
                        <img class="profile-image"  src="data:image/jpeg;base64,{{($people->image) }}">
                    @else
                        <!-- If image is not available, check the gender and show default images -->

                            @php
                                // Debugging step to check gender
                                $gender = $people->gender ?? null;
                            @endphp
                            @if ($gender === 'Male')
                                <img class="profile-image" src="{{ asset('images/male-default.png') }}" alt="Default Male Image">
                            @elseif($gender === 'Female')
                                <img class="profile-image" src="{{ asset('images/female-default.jpg') }}" alt="Default Female Image">
                          
                        @else
                            <!-- Fallback if emp is not available -->
                            <img class="profile-image" src="{{ asset('images/user.jpg') }}" alt="Default Image">
                        @endif
                    @endif
                        </div>
                        <div class="col">
                            <h6 class="username" style="font-size: 12px; color: white;">{{ ucwords(strtolower($people->first_name)) }} {{ ucwords(strtolower($people->last_name)) }}</h6>
                            <p class="mb-0" style="font-size: 12px; color: white;">(#{{ $people->emp_id }})</p>
                        </div>
                    </div>
                </label>
            @endforeach
        @endif
    </div>
@endif

                                                            </div>
                                                            <div class="row mt-2">
                            <div class="col">
                                <label for="fileInput" style="color:#778899;font-weight:500;font-size:12px;cursor:pointer;">
                                    <i class="fa fa-paperclip"></i> Attach Image
                                </label>
                            </div>
                            @error('file_path') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div>
                        <input type="file" wire:model="file_path" id="file_path" class="form-control">

                        </div>

                                                        </form>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                    <button type="button" wire:click="Devops" class="submit-btn">Submit</button>
                                                        <button wire:click="closecatalog" type="button" class="cancel-btn" style="border:1px solid rgb(2,17,79);">Cancel</button>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-backdrop fade show blurred-backdrop" style="{{ $showModal ? '' : 'display: none;' }}"></div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;">
                                    <p style="font-size: 12px;"><b>MMS Account Request</b></p>
                                    <div class="row m-0">
                                        <div class="col-12 text-center mb-2">
                                            <img src="https://snow.payg.in/79ee2f8187c0b510e34c63d70cbb355f.iix?t=medium" style="width: 4em; height:4em;">
                                        </div>
                                        <div class="col-12 mb-2" style="font-size:12px">
                                            <p style="text-decoration:underline;cursor: pointer; text-align: center;" wire:click="MmsRequest">MMS Account Request</p>
                                        </div>
                                        @if($MmsRequestaceessDialog)
                                        <div class="modal" tabindex="-1" role="dialog" style="{{ $showModal ? 'display: block;' : 'display: none;' }}">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">MMS Account Request</h1>

                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row m-0">
                                                            <div class="col-4 m-auto">
                                                                <img src="https://snow.payg.in/79ee2f8187c0b510e34c63d70cbb355f.iix?t=medium" style="height:7em">
                                                            </div>
                                                            <div class="col-8 m-auto">
                                                                <p style="font-size:15px;">MMS Account Request</p>
                                                            </div>
                                                        </div>
                                                        <hr style="border: 1px solid #ccc;margin: 10px 0;">
                                                        <form wire:submit.prevent="Devops">


                                                            <div style="display:flex">
                                                                <div class="form-group col-md-6 mt-2">
                                                                    <label for="contactDetails">Mobile Number<span  style="color:red">*</span></label>
                                                                    <input wire:model="mobile"  wire:keydown.debounce.500ms="validateField('mobile')" type="text" class="form-control">
                                                                    @error('mobile') <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-6 mt-2 ml-3" style="margin-left:10px">
                                                                    <label for="contactDetails">Email<span  style="color:red">*</span></label>
                                                                    <input wire:model="mail"  wire:keydown.debounce.500ms="validateField('mail')" type="text" class="form-control">
                                                                    @error('mail') <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label for="contactDetails">Business Justification<span  style="color:red">*</span></label>
                                                                <input wire:model="subject"  wire:keydown.debounce.500ms="validateField('subject')" type="text" class="form-control">
                                                                @error('subject') <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label for="reason">Specific Information<span  style="color:red">*</span></label>
                                                                <textarea wire:model="description"  wire:keydown.debounce.500ms="validateField('description')" class="form-control"></textarea>
                                                                @error('description') <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <label for="cc_to" class="form-label"> Request For : <span style="font-size:12px"> {{ implode(', ', array_unique($selectedPeopleNames)) }}</span></label>

                                                                        @if (session()->has('selecterror'))
    <div class="alert alert-danger">
        {{ session('selecterror') }}
    </div>
@endif

                                                                    </div>
                                                                    <div class="row m-0">
                                                                        <div class="form-group mb-3 p-0">
                                                                            <button type="button" class="btn btn" wire:click="NamesSearch" style="background-color: rgb(2, 17, 79);color:white">
                                                                                <i class="fa fa-plus me-3"></i>
                                                                                Add
                                                                            </button>
                                                                        </div>

                                                                        @error('cc_to') <span class="text-danger" style="margin-left:20px">{{ $message }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                                @if($isNames)
    <div style="border-radius:5px; background-color:grey; padding:8px; width:330px; margin-top:10px; height:200px; overflow-y:auto;margin-left:10px">
    <div class="input-group6" style="display: flex; align-items: center; width: 100%;">
    <input 
        wire:model="searchTerm" 
        style="font-size: 10px; cursor: pointer; border-radius: 5px 0 0 5px; width: 250px; height: 30px; padding: 5px;" 
        type="text" 
        class="form-control" 
        placeholder="Search for Emp.Name or ID" 
        aria-label="Search" 
        aria-describedby="basic-addon1"
    >
    <div class="input-group-append" style="display: flex; align-items: center;">
        <button 
            wire:click="filter" 
            style="height: 30px; border-radius: 0 5px 5px 0; background-color: rgb(2, 17, 79); color: #fff; border: none; padding: 0 10px;" 
            class="btn" 
            type="button"
        >
            <i style="text-align: center;" class="fa fa-search"></i>
        </button>

        <button 
            wire:click="closePeoples"  
            type="button" 
            class="close rounded px-1 py-0" 
            aria-label="Close" 
            style="background-color: rgb(2,17,79); height: 30px; width: 30px; margin-left: 5px; display: flex; align-items: center; justify-content: center;"
        >
            <span aria-hidden="true" style="color: white; font-size: 24px; line-height: 0;">×</span>
        </button>
    </div>
</div>
        @if ($peopleData->isEmpty())
            <div class="container" style="text-align: center; color: white; font-size:12px">
                No People Found
            </div>
        @else
            @foreach($peopleData->sortBy(function($people) { return strtolower($people->first_name) . ' ' . strtolower($people->last_name); }) as $people)
                <label wire:click="selectPerson('{{ $people->emp_id }}')" class="container" style="cursor: pointer; background-color: darkgrey; padding: 5px; margin-top: 10px; width: 300px; border-radius: 5px;">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <input type="checkbox"  class="form-check-input custom-checkbox-helpdesk" id="person-{{ $people->emp_id }}" wire:model="selectedPeople" value="{{ $people->emp_id }}" {{ $people->isChecked ? 'checked' : '' }}>
                        </div>
                        <div class="col-auto">
                        @if (!empty($people->image) && $people->image !== 'null')
                        <!-- Display the actual image if available -->
                        <img class="profile-image"  src="data:image/jpeg;base64,{{($people->image) }}">
                    @else
                        <!-- If image is not available, check the gender and show default images -->

                            @php
                                // Debugging step to check gender
                                $gender = $people->gender ?? null;
                            @endphp
                            @if ($gender === 'Male')
                                <img class="profile-image" src="{{ asset('images/male-default.png') }}" alt="Default Male Image">
                            @elseif($gender === 'Female')
                                <img class="profile-image" src="{{ asset('images/female-default.jpg') }}" alt="Default Female Image">
                          
                        @else
                            <!-- Fallback if emp is not available -->
                            <img class="profile-image" src="{{ asset('images/user.jpg') }}" alt="Default Image">
                        @endif
                    @endif
                        </div>
                        <div class="col">
                            <h6 class="username" style="font-size: 12px; color: white;">{{ ucwords(strtolower($people->first_name)) }} {{ ucwords(strtolower($people->last_name)) }}</h6>
                            <p class="mb-0" style="font-size: 12px; color: white;">(#{{ $people->emp_id }})</p>
                        </div>
                    </div>
                </label>
            @endforeach
        @endif
    </div>
@endif

                                                            </div>

                                                            <div class="row ">
                            <div class="col">
                                <label for="fileInput" style="color:#778899;font-weight:500;font-size:12px;cursor:pointer;">
                                    <i class="fa fa-paperclip"></i> Attach Image
                                </label>
                            </div>
                            @error('file_path') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div>
                        <input type="file" wire:model="file_path" id="file_path" class="form-control">

                        </div>

                                                        </form>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">

<button type="button" wire:click="Devops" class="submit-btn">Submit</button>
                                                        <button wire:click="closecatalog" type="button" class="cancel-btn" style="border:1px solid rgb(2,17,79);">Cancel</button>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-backdrop fade show blurred-backdrop" style="{{ $showModal ? '' : 'display: none;' }}"></div>
                                        @endif
                                    </div>
        
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;">
                                    <p style="font-size: 12px;"><b>New Distribution List</b></p>
                                    <div class="row m-0">
                                        <div class="col-12 text-center mb-2" style="font-size:12px">
                                            <img src="https://snow.payg.in/feaa4ca9871c7510279786a50cbb3576.iix?t=medium" style="height:4em;">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <p style="text-decoration:underline;cursor: pointer; text-align: center;font-size:12px;" wire:click="DistributionRequest">New Distribution List</p>
                                        </div>
                                        @if($DistributionRequestaceessDialog)
                                        <div class="modal" tabindex="-1" role="dialog" style="{{ $showModal ? 'display: block;' : 'display: none;' }}">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">New Distribution List</h1>

                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row m-0">
                                                            <div class="col-4 m-auto">
                                                                <img src="https://snow.payg.in/feaa4ca9871c7510279786a50cbb3576.iix?t=medium" style="height:7em">
                                                            </div>
                                                            <div class="col-8 m-auto">
                                                                <p style="font-size:15px;">Use this Catalogue Item to raise New Request for Adding a New Distribution List</p>
                                                            </div>
                                                        </div>
                                                        <hr style="border: 1px solid #ccc;margin: 10px 0;">

                                                        <form wire:submit.prevent="DistributorRequest">

                                                            <div class="form-group mt-2">
                                                                <label for="contactDetails">Provide the Name of Distribution List<span style="color:red">*</span></label>
                                                                <input wire:model.lazy="distributor_name"  wire:keydown.debounce.500ms="validateField('distributor_name')" type="text" class="form-control">
                                                                @error('distributor_name') <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>



                                                            <div class="form-group mt-2">
                                                                <label for="contactDetails">Business Justification<span style="color:red">*</span></label>
                                                                <input wire:model.lazy="subject"   wire:keydown.debounce.500ms="validateField('subject')" type="text" class="form-control">
                                                                @error('subject') <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label for="reason">Specific Information<span style="color:red">*</span></label>
                                                                <textarea wire:model.lazy="description"  wire:keydown.debounce.500ms="validateField('description')" class="form-control"></textarea>
                                                                @error('description') <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="row m-0" style="margin-left:-10px">
                                                                <div class="row mt-2" >
                                                                    <div class="form-group">

                                                                        <div class="form-group m-0 p-0">
                                                                            <label for="cc_to" class="form-label" style="margin-left:-13px"> Members to be Added :<span style="font-size:12px"> {{ implode(', ', array_unique($selectedPeopleNames)) }}</span></label>
                                                                            @if (session()->has('selecterror'))
    <div class="alert alert-danger">
        {{ session('selecterror') }}
    </div>
@endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="row m-0">
                                                                        <div class="form-group " style="margin-left:-18px">
                                                                            <button type="button" class="btn btn" wire:click="NamesSearch" style="background-color: rgb(2, 17, 79);color:white">
                                                                                <i class="fa fa-plus me-3"></i>
                                                                                Add
                                                                            </button>
                                                                        </div>

                                                                        @error('cc_to') <span class="text-danger">{{ $message }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                                @if($isNames)
    <div style="border-radius:5px; background-color:grey; padding:8px; width:330px; margin-top:10px; height:200px; overflow-y:auto;">
    <div class="input-group7" style="display: flex; align-items: center; width: 100%;">
    <input 
        wire:model="searchTerm" 
        style="font-size: 10px; cursor: pointer; border-radius: 5px 0 0 5px; width: 250px; height: 30px; padding: 5px;" 
        type="text" 
        class="form-control" 
        placeholder="Search for Emp.Name or ID" 
        aria-label="Search" 
        aria-describedby="basic-addon1"
    >
    <div class="input-group-append" style="display: flex; align-items: center;">
        <button 
            wire:click="filter" 
            style="height: 30px; border-radius: 0 5px 5px 0; background-color: rgb(2, 17, 79); color: #fff; border: none; padding: 0 10px;" 
            class="btn" 
            type="button"
        >
            <i style="text-align: center;" class="fa fa-search"></i>
        </button>

        <button 
            wire:click="closePeoples"  
            type="button" 
            class="close rounded px-1 py-0" 
            aria-label="Close" 
            style="background-color: rgb(2,17,79); height: 30px; width: 30px; margin-left: 5px; display: flex; align-items: center; justify-content: center;"
        >
            <span aria-hidden="true" style="color: white; font-size: 24px; line-height: 0;">×</span>
        </button>
    </div>
</div>
        @if ($peopleData->isEmpty())
            <div class="container" style="text-align: center; color: white; font-size:12px">
                No People Found
            </div>
        @else
            @foreach($peopleData->sortBy(function($people) { return strtolower($people->first_name) . ' ' . strtolower($people->last_name); }) as $people)
                <label wire:click="selectPerson('{{ $people->emp_id }}')" class="container" style="cursor: pointer; background-color: darkgrey; padding: 5px; margin-top: 10px; width: 300px; border-radius: 5px;">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <input type="checkbox"  class="form-check-input custom-checkbox-helpdesk" id="person-{{ $people->emp_id }}" wire:model="selectedPeople" value="{{ $people->emp_id }}" {{ $people->isChecked ? 'checked' : '' }}>
                        </div>
                        <div class="col-auto">
                        @if (!empty($people->image) && $people->image !== 'null')
                        <!-- Display the actual image if available -->
                        <img class="profile-image"  src="data:image/jpeg;base64,{{($people->image) }}">
                    @else
                        <!-- If image is not available, check the gender and show default images -->

                            @php
                                // Debugging step to check gender
                                $gender = $people->gender ?? null;
                            @endphp
                            @if ($gender === 'Male')
                                <img class="profile-image" src="{{ asset('images/male-default.png') }}" alt="Default Male Image">
                            @elseif($gender === 'Female')
                                <img class="profile-image" src="{{ asset('images/female-default.jpg') }}" alt="Default Female Image">
                          
                        @else
                            <!-- Fallback if emp is not available -->
                            <img class="profile-image" src="{{ asset('images/user.jpg') }}" alt="Default Image">
                        @endif
                    @endif
                        </div>
                        <div class="col">
                            <h6 class="username" style="font-size: 12px; color: white;">{{ ucwords(strtolower($people->first_name)) }} {{ ucwords(strtolower($people->last_name)) }}</h6>
                            <p class="mb-0" style="font-size: 12px; color: white;">(#{{ $people->emp_id }})</p>
                        </div>
                    </div>
                </label>
            @endforeach
        @endif
    </div>
@endif

                                                            </div>
                                                            <div class="row mt-2">
                            <div class="col">
                                <label for="fileInput" style="color:#778899;font-weight:500;font-size:12px;cursor:pointer;">
                                    <i class="fa fa-paperclip"></i> Attach Image
                                </label>
                            </div>
                            @error('file_path') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div>
                        <input type="file" wire:model="file_path" id="file_path" class="form-control">

                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                    <div class="m-0 p-0 mt-3 d-flex gap-3 justify-content-center">

<button type="button" wire:click="DistributorRequest" class="submit-btn">Submit</button>
                                                        <button wire:click="closecatalog" type="button" class="cancel-btn" style="border:1px solid rgb(2,17,79);">Cancel</button>
</div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-backdrop fade show blurred-backdrop" style="{{ $showModal ? '' : 'display: none;' }}"></div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-md-4 mb-4">
                                <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;">
                                    <p style="font-size: 12px;"><b> Laptop Request</b></p>
                                    <div class="row m-0">
                                        <div class="col-12 text-center mb-2" style="font-size:12px">
                                            <img src="https://snow.payg.in/1a00f1cb878cb950279786a50cbb35ea.iix?t=medium" style="height:4em;">
                                        </div>
                                        <div class="col-12 mb-2" style="font-size:12px">
                                            <p style="text-decoration:underline;cursor: pointer; text-align: center;" wire:click="LapRequest">Laptop Request</p>
                                        </div>
                                        @if($LapRequestaceessDialog)
                                        <div class="modal" tabindex="-1" role="dialog" style="{{ $showModal ? 'display: block;' : 'display: none;' }}">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel"> Laptop Request</h1>

                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row m-0">
                                                            <div class="col-4 m-auto">
                                                                <img src="https://snow.payg.in/1a00f1cb878cb950279786a50cbb35ea.iix?t=medium" style="height:7em">
                                                            </div>
                                                            <div class="col-8 m-auto">
                                                                <p style="font-size:15px;"> Laptop Request</p>
                                                            </div>
                                                        </div>
                                                        <hr style="border: 1px solid #ccc;margin: 10px 0;">
                                                        <form wire:submit.prevent="Devops">

                                                        <div class="form-group col-md-6 mt-2">
                                                                <label for="Name">Requested By:</label>
                                                               
                                                             
                                                                <div class="input-group mb-3">
                                                               

                                                             
                                                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-info-circle" style="color:blue"></i></span> <!-- Change label as needed -->
                @if($employeeDetails)
                <input  wire:model.lazy="full_name"  type="text"  class="form-control" aria-describedby="basic-addon1"  readonly  >
    @else
        <p>No employee details found.</p>
    @endif
    </div>
                                                             
                                                            </div>

                                                            <div style="display:flex">
                                                         
                                                            <div class="form-group col-md-6 mt-2">
        <label for="mobile">Mobile Number <span style="color:red">*</span></label>
        <input wire:model.lazy="mobile" wire:keydown.debounce.500ms="validateField('mobile')" type="text" class="form-control">
        @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
<div class="form-group col-md-6 mt-2 ml-3" style="margin-left:10px">
    <label for="contactDetails">Email <span style="color:red">*</span></label>
    <input wire:model.lazy="mail" wire:keydown.debounce.500ms="validateField('mail')" type="text" class="form-control">
    @error('mail') <span class="text-danger">{{ $message }}</span> @enderror
</div>

                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label for="contactDetails">Business Justification<span style="color:red">*</span></label>
                                                                <input wire:model.lazy="subject"  wire:keydown.debounce.500ms="validateField('subject')" type="text" class="form-control">
                                                                @error('subject') <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label for="reason">Specific Information<span style="color:red">*</span></label>
                                                                <textarea wire:model.lazy="description"  wire:keydown.debounce.500ms="validateField('description')" class="form-control"></textarea>
                                                                @error('description') <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="row">
                                                                <div class="row">
                                                                    <div class="form-group ">
                                                                        <label for="cc_to" class="form-label"> Request For : <span style="font-size:12px"> {{ implode(', ', array_unique($selectedPeopleNames)) }}</span></label>
                                                                        @if (session()->has('selecterror'))
    <div class="alert alert-danger">
        {{ session('selecterror') }}
    </div>
@endif
                                                                    </div>
                                                                    <div class="row m-0">
                                                                        <div class="form-group  p-0">
                                                                            <button type="button" class="btn btn" wire:click="NamesSearch" style="background-color: rgb(2, 17, 79);color:white">
                                                                                <i class="fa fa-plus me-3"></i>
                                                                                Add
                                                                            </button>
                                                                        </div>

                                                                        @error('cc_to') <span class="text-danger" style="margin-left:20px">{{ $message }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                                @if($isNames)
    <div style="border-radius:5px; background-color:grey; padding:8px; width:330px; margin-top:10px; height:200px; overflow-y:auto;margin-left:10px">
    <div class="input-group9" style="display: flex; align-items: center; width: 100%;">
    <input 
        wire:model="searchTerm" 
        style="font-size: 10px; cursor: pointer; border-radius: 5px 0 0 5px; width: 250px; height: 30px; padding: 5px;" 
        type="text" 
        class="form-control" 
        placeholder="Search for Emp.Name or ID" 
        aria-label="Search" 
        aria-describedby="basic-addon1"
    >
    <div class="input-group-append" style="display: flex; align-items: center;">
        <button 
            wire:click="filter" 
            style="height: 30px; border-radius: 0 5px 5px 0; background-color: rgb(2, 17, 79); color: #fff; border: none; padding: 0 10px;" 
            class="btn" 
            type="button"
        >
            <i style="text-align: center;" class="fa fa-search"></i>
        </button>

        <button 
            wire:click="closePeoples"  
            type="button" 
            class="close rounded px-1 py-0" 
            aria-label="Close" 
            style="background-color: rgb(2,17,79); height: 30px; width: 30px; margin-left: 5px; display: flex; align-items: center; justify-content: center;"
        >
            <span aria-hidden="true" style="color: white; font-size: 24px; line-height: 0;">×</span>
        </button>
    </div>
</div>
        @if ($peopleData->isEmpty())
            <div class="container" style="text-align: center; color: white; font-size:12px">
                No People Found
            </div>
        @else
            @foreach($peopleData->sortBy(function($people) { return strtolower($people->first_name) . ' ' . strtolower($people->last_name); }) as $people)
                <label wire:click="selectPerson('{{ $people->emp_id }}')" class="container" style="cursor: pointer; background-color: darkgrey; padding: 5px; margin-top: 10px; width: 300px; border-radius: 5px;">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <input type="checkbox" class="form-check-input custom-checkbox-helpdesk"  id="person-{{ $people->emp_id }}" wire:model="selectedPeople" value="{{ $people->emp_id }}" {{ $people->isChecked ? 'checked' : '' }}>
                        </div>
                        <div class="col-auto">
                        @if (!empty($people->image) && $people->image !== 'null')
                        <!-- Display the actual image if available -->
                        <img class="profile-image"  src="data:image/jpeg;base64,{{($people->image) }}">
                    @else
                        <!-- If image is not available, check the gender and show default images -->

                            @php
                                // Debugging step to check gender
                                $gender = $people->gender ?? null;
                            @endphp
                            @if ($gender === 'Male')
                                <img class="profile-image" src="{{ asset('images/male-default.png') }}" alt="Default Male Image">
                            @elseif($gender === 'Female')
                                <img class="profile-image" src="{{ asset('images/female-default.jpg') }}" alt="Default Female Image">
                          
                        @else
                            <!-- Fallback if emp is not available -->
                            <img class="profile-image" src="{{ asset('images/user.jpg') }}" alt="Default Image">
                        @endif
                    @endif
                        </div>
                        <div class="col">
                            <h6 class="username" style="font-size: 12px; color: white;">{{ ucwords(strtolower($people->first_name)) }} {{ ucwords(strtolower($people->last_name)) }}</h6>
                            <p class="mb-0" style="font-size: 12px; color: white;">(#{{ $people->emp_id }})</p>
                        </div>
                    </div>
                </label>
            @endforeach
        @endif
    </div>
@endif

                                                            </div>
                                                            <div class="row mt-2">
                            <div class="col">
                                <label for="fileInput" style="color:#778899;font-weight:500;font-size:12px;cursor:pointer;">
                                    <i class="fa fa-paperclip"></i> Attach Image
                                </label>
                            </div>
                            @error('file_path') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div>
                        <input type="file" wire:model="file_path" id="file_path" class="form-control">

                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                    <div class="m-0 p-0 mt-3 d-flex gap-3 justify-content-center">

<button type="button" wire:click="Devops" class="submit-btn">Submit</button>

                                                        <button wire:click="closecatalog" type="button" class="cancel-btn" style="border:1px solid rgb(2,17,79);">Cancel</button>
</div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-backdrop fade show blurred-backdrop" style="{{ $showModal ? '' : 'display: none;' }}"></div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;">
                                    <p style="font-size: 12px;"><b>New Mailbox Request</b></p>
                                    <div class="row m-0">
                                        <div class="col-12 text-center mb-2" style="font-size:12px">
                                            <img src="https://snow.payg.in/723bc4e9871c7510279786a50cbb3585.iix?t=medium" style="width: 4em; height:4em;">
                                        </div>
                                        <div class="col-12 mb-2" style="font-size:12px">
                                            <p style="text-decoration:underline;cursor: pointer; text-align: center;">New Mailbox Request</p>
                                        </div>
                                    </div>
 
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;">
                                    <p style="font-size: 12px;"><b>Devops Access Request</b></p>
                                    <div class="row m-0">
                                        <div class="col-12 text-center mb-2" style="font-size:12px">
                                            <img src="https://snow.payg.in/3111f90f878cb950279786a50cbb359b.iix?t=medium" style="height:4em;">
                                        </div>
                                        <div class="col-12 mb-2" style="font-size:12px">
                                            <p style="text-decoration:underline;cursor: pointer; text-align: center;" wire:click="DevopsRequest">Devops Access Request</p>
                                        </div>
                                        @if($DevopsRequestaceessDialog)
                                        <div class="modal" tabindex="-1" role="dialog" style="{{ $showModal ? 'display: block;' : 'display: none;' }}">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Devops Access Request</h1>

                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row m-0">
                                                            <div class="col-4 m-auto">
                                                                <img src="https://snow.payg.in/3111f90f878cb950279786a50cbb359b.iix?t=medium" style="height:7em">
                                                            </div>
                                                            <div class="col-8 m-auto">
                                                                <p style="font-size:15px;"> Devops Access Request</p>
                                                            </div>
                                                        </div>
                                                        <hr style="border: 1px solid #ccc;margin: 10px 0;">
                                                        <form wire:submit.prevent="Devops">



                                                            <div style="display:flex">
                                                                <div class="form-group col-md-6 mt-2">
                                                                    <label for="contactDetails">Mobile Number<span style="color:red">*</span></label>
                                                                    <input wire:model.lazy="mobile" type="text" class="form-control">
                                                                    @error('mobile') <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-6 mt-2 ml-3" style="margin-left:10px">
                                                                    <label for="contactDetails">Email<span style="color:red">*</span></label>
                                                                    <input wire:model.lazy="mail" type="text" class="form-control">
                                                                    @error('mail') <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label for="contactDetails">Business Justification<span style="color:red">*</span></label>
                                                                <input wire:model.lazy="subject" type="text" class="form-control">
                                                                @error('subject') <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label for="reason">Specific Information<span style="color:red">*</span></label>
                                                                <textarea wire:model.lazy="description" class="form-control"></textarea>
                                                                @error('description') <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="row " >
                                                                <div class="row">
                                                                    <div class="form-group mt-2">
                                                                        <label for="cc_to" class="form-label"> Request For : <span style="font-size:12px"> {{ implode(', ', array_unique($selectedPeopleNames)) }}</span></label>
                                                                        @if (session()->has('selecterror'))
    <div class="alert alert-danger">
        {{ session('selecterror') }}
    </div>
@endif
                                                                    </div>
                                                                    <div class="form-group m-0">
                                                                        <div class=" p-0">
                                                                            <button type="button" class="btn btn" wire:click="NamesSearch" style="background-color: rgb(2, 17, 79);color:white;margin-left:-5px">
                                                                                <i class="fa fa-plus me-3"></i>
                                                                                Add
                                                                            </button>
                                                                        </div>

                                                                        @error('cc_to') <span class="text-danger" style="margin-left:20px">{{ $message }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                                @if($isNames)
    <div style="border-radius:5px; background-color:grey; padding:8px; width:330px; margin-top:10px; height:200px; overflow-y:auto;margin-left:10px">
    <div class="input-group9" style="display: flex; align-items: center; width: 100%;">
    <input 
        wire:model="searchTerm" 
        style="font-size: 10px; cursor: pointer; border-radius: 5px 0 0 5px; width: 250px; height: 30px; padding: 5px;" 
        type="text" 
        class="form-control" 
        placeholder="Search for Emp.Name or ID" 
        aria-label="Search" 
        aria-describedby="basic-addon1"
    >
    <div class="input-group-append" style="display: flex; align-items: center;">
        <button 
            wire:click="filter" 
            style="height: 30px; border-radius: 0 5px 5px 0; background-color: rgb(2, 17, 79); color: #fff; border: none; padding: 0 10px;" 
            class="btn" 
            type="button"
        >
            <i style="text-align: center;" class="fa fa-search"></i>
        </button>

        <button 
            wire:click="closePeoples"  
            type="button" 
            class="close rounded px-1 py-0" 
            aria-label="Close" 
            style="background-color: rgb(2,17,79); height: 30px; width: 30px; margin-left: 5px; display: flex; align-items: center; justify-content: center;"
        >
            <span aria-hidden="true" style="color: white; font-size: 24px; line-height: 0;">×</span>
        </button>
    </div>
</div>
        @if ($peopleData->isEmpty())
            <div class="container" style="text-align: center; color: white; font-size:12px">
                No People Found
            </div>
        @else
            @foreach($peopleData->sortBy(function($people) { return strtolower($people->first_name) . ' ' . strtolower($people->last_name); }) as $people)
                <label wire:click="selectPerson('{{ $people->emp_id }}')" class="container" style="cursor: pointer; background-color: darkgrey; padding: 5px; margin-top: 10px; width: 300px; border-radius: 5px;">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <input type="checkbox"class="form-check-input custom-checkbox-helpdesk" id="person-{{ $people->emp_id }}" wire:model="selectedPeople" value="{{ $people->emp_id }}" {{ $people->isChecked ? 'checked' : '' }}>
                        </div>
                        <div class="col-auto">
                        @if (!empty($people->image) && $people->image !== 'null')
                        <!-- Display the actual image if available -->
                        <img class="profile-image"  src="data:image/jpeg;base64,{{($people->image) }}">
                    @else
                        <!-- If image is not available, check the gender and show default images -->

                            @php
                                // Debugging step to check gender
                                $gender = $people->gender ?? null;
                            @endphp
                            @if ($gender === 'Male')
                                <img class="profile-image" src="{{ asset('images/male-default.png') }}" alt="Default Male Image">
                            @elseif($gender === 'Female')
                                <img class="profile-image" src="{{ asset('images/female-default.jpg') }}" alt="Default Female Image">
                          
                        @else
                            <!-- Fallback if emp is not available -->
                            <img class="profile-image" src="{{ asset('images/user.jpg') }}" alt="Default Image">
                        @endif
                    @endif
                        </div>
                        <div class="col">
                            <h6 class="username" style="font-size: 12px; color: white;">{{ ucwords(strtolower($people->first_name)) }} {{ ucwords(strtolower($people->last_name)) }}</h6>
                            <p class="mb-0" style="font-size: 12px; color: white;">(#{{ $people->emp_id }})</p>
                        </div>
                    </div>
                </label>
            @endforeach
        @endif
    </div>
@endif

                                                            </div>
                                                            <div class="row mt-2">
                            <div class="col">
                                <label for="fileInput" style="color:#778899;font-weight:500;font-size:12px;cursor:pointer;">
                                    <i class="fa fa-paperclip"></i> Attach Image
                                </label>
                            </div>
                            @error('file_path') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div>
                        <input type="file" wire:model="file_path" id="file_path" class="form-control">

                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                    <button type="button" wire:click="Devops" class="submit-btn">Submit</button>


                                                        <button wire:click="closecatalog" type="button" class="cancel-btn" style="border:1px solid rgb(2,17,79);">Cancel</button>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-backdrop fade show blurred-backdrop" style="{{ $showModal ? '' : 'display: none;' }}"></div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>



                        <div id="showBtnDiv" class="row m-0 mb-4 showIt" style="text-align: center">
                            <div>
                                <button class="cancel-btn" onclick="showMoreItems()" style="border: 1px solid rgb(2,17,79);">Show More Items</button>
                            </div>
                        </div>

                        <div id="requestCard" class="row m-0 hideIt">
                            <div class="row m-0">
                                <div class="col-md-4 mb-4">
                                    <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;height: 220px;">
                                        <p style="font-size: 12px;"><b>O365 Desktop License Access</b></p>
                                        <div class="row m-0">
                                            <div class="col-12 text-center mb-2">
                                                <img src="https://snow.payg.in/a9fa00e9871c7510279786a50cbb3525.iix?t=medium" style="height:4em;">
                                            </div>
                                            <div class="col-12 mb-2" style="font-size:12px">
                                                <p style="text-decoration:underline;cursor: pointer; text-align: center;">O365 Desktop License Access</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;height: 220px;">
                                        <p style="font-size: 12px;"><b>Other Request</b></p>
                                        <div class="row m-0 mb-5">
                                            <p class="p-0" style="cursor: pointer; margin-bottom: 4.4em;text-decoration:underline;text-align: center;font-size:12px">Other Service Request</p>
                                        </div>
        
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;height: 220px;">
                                        <p style=" font-size: 12px;"><b>Privilege Access Request</b></p>
                                        <div class="row m-0 mb-5">
                                            <p class="p-0" style="cursor: pointer; margin-bottom: 4.4em;text-decoration:underline;text-align: center;font-size:12px">Privilege Access Request</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row m-0">
                                <div class="col-md-4 mb-4">
                                    <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;height: 220px;">
                                        <p style="font-size: 12px;"><b>Remove from Distribution List</b></p>
                                        <div class="row m-0">
                                            <div class="col-12 text-center mb-2">
                                                <img src="https://snow.payg.in/6dfb082d871c7510279786a50cbb3590.iix?t=medium" style="height:4em;">
                                            </div>
                                            <div class="col-12 mb-2 text-center">
                                                <div style="max-width: 100%; overflow: hidden;">
                                                    <p style="text-decoration:underline; cursor: pointer;font-size:12px ">Remove Members from Distribution List</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                                <div class="col-md-4 mb-4">
                                    <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;height: 220px;">
                                        <p style="font-size: 12px;"><b>Remove from Mailbox</b></p>
                                        <div class="row m-0">
                                            <div class="col-12 text-center mb-2">
                                                <img src="https://snow.payg.in/6dfb082d871c7510279786a50cbb3590.iix?t=medium" style="height:4em;">
                                            </div>
                                            <div class="col-12 mb-2">
                                                <p style="text-decoration:underline;cursor: pointer; text-align: center;font-size:12px">Remove Members from Mailbox</p>
                                            </div>
                                        </div>
                                       
                                </div>
</div>
                                <div class="col-md-4 mb-4">
                                    <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;height: 220px;">
                                        <p style="font-size: 12px;"><b>SIM Request</b></p>
                                        <div class="row m-0">
                                            <div class="col-12 text-center mb-2">
                                                <img src="https://snow.payg.in/ef99c469871c7510279786a50cbb357f.iix?t=medium" style="height:4em;">
                                            </div>
                                            <div class="col-12 mb-2">
                                                <p style="text-decoration:underline;cursor: pointer; text-align: center;font-size: 12px;">New SIM Request</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                </section>

                <section id="cataLogListView" class="hideIt table-responsive">
                    <table class="custom-table-catalog px-2 border rounded " style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th style="width:40%;padding:10px;">Item</th>
                                <th style="width:60%;padding:10px;">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="item-td">
                                    <img src="https://snow.payg.in/89294c29871c7510279786a50cbb35b5.iix?t=medium" class="me-3" style="height:4em;">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 12px;white-space: nowrap;" wire:click="AddRequest">Add Members to Distribution List</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">Add Members to Distribution List</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="item-td">
                                    <img src="https://snow.payg.in/c3d8c429871c7510279786a50cbb3564.iix?t=medium" class="me-3" style="height:4em;">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 12px;white-space: nowrap;"  wire:click="MailRequest">Add Members to Mailbox</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">Add Members to Mailbox</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="item-td">
                                    <img src="https://snow.payg.in/3111f90f878cb950279786a50cbb359b.iix?t=medium" class="me-3" style="height:4em;">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 14px;white-space: nowrap;"  wire:click="DevopsRequest">Devops Access Request</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">Devops Access Request</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="item-td">
                                    <img src="https://snow.payg.in/673ac469871c7510279786a50cbb3563.iix?t=medium" class="me-3" style="height:4em;">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 12px;white-space: nowrap;"  wire:click="IdRequest">ID Card Request</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">New ID Card Request</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="item-td">
                                    <img src="https://snow.payg.in/79ee2f8187c0b510e34c63d70cbb355f.iix?t=medium" class="me-3" style="height:4em;">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 12px;white-space: nowrap;" wire:click="MmsRequest">MMS Account Request</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">MMS Account Request</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="item-td">
                                    <img src="https://snow.payg.in/feaa4ca9871c7510279786a50cbb3576.iix?t=medium" class="me-3" style="height:4em;">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 12px;white-space: nowrap;"  wire:click="DistributionRequest">New Distribution List</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">New Distribution List</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="item-td">
                                    <img src="https://snow.payg.in/1a00f1cb878cb950279786a50cbb35ea.iix?t=medium" class="me-3" style="height:4em;">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 12px;white-space: nowrap;" wire:click="LapRequest">New Laptop Request</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;font-size:12px">
                                    <p style="font-size: 12px">New Laptop Request</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="item-td">
                                    <img src="https://snow.payg.in/723bc4e9871c7510279786a50cbb3585.iix?t=medium" class="me-3" style="height:4em;">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 14px;white-space: nowrap;">New Mailbox Request</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">New Mailbox Request</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="item-td">
                                    <img src="https://snow.payg.in/a9fa00e9871c7510279786a50cbb3525.iix?t=medium" class="me-3" style="height:4em;">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 12px;white-space: nowrap;">O365 Desktop License Access</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">O365 Desktop License Access</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="item-td">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 12px;white-space: nowrap;">Other Request</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">Other Service Request</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="item-td">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 12px;white-space: nowrap;">Privilege Access Request</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">Privilege Access Request</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="item-td">
                                    <img src="https://snow.payg.in/6dfb082d871c7510279786a50cbb3590.iix?t=medium" class="me-3" style="height:4em;">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 12px;white-space: nowrap;">Remove Members from Distribution List</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">Remove Members from Distribution List</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="item-td">
                                    <img src="https://snow.payg.in/6dfb082d871c7510279786a50cbb3590.iix?t=medium" class="me-3" style="height:4em;">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 12px;white-space: nowrap;">Remove Members from Mailbox</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">Remove Members from Mailbox</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="item-td">
                                    <img src="https://snow.payg.in/cc7c281087dc7150fc21ed7bbbbb356b.iix?t=medium" class="me-3" style="height:4em;">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 12px;white-space: nowrap;" wire:click="ItRequest">Request for IT Accessories</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">Request for IT Accessories</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="item-td">
                                    <img src="https://snow.payg.in/ef99c469871c7510279786a50cbb357f.iix?t=medium" class="me-3" style="height:4em;">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 12px;white-space: nowrap;">SIM Request</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">New SIM Request</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>

            </div>
        </div>

        <div id="standardChanges" class="col-md-9 mb-4 hideIt">
            <div class="row m-0" style="background:white; border:1px solid grey; border-radius:5px;">
                <div class="row m-0">
                    <div class="col-6">
                        <h4 class="mt-4 mb-2">Standard Changes</h4>
                        <p class="mb-4">Standard Change Template Library</p>
                    </div>
                    <div class="col-6" style="text-align: right; margin: auto; font-size: 13px; padding-right: 15px;">
                        <i class="fas fa-table catalogCardIcon" id="standCardView" onclick="changeView('standCardView')" style="padding: 5px; border-radius: 10%; cursor: pointer; color: #333;"></i>
                        <span style="border: 1px solid" class="me-3 ms-1"></span>
                        <i class="far fa-list-alt catalogCardIcon" id="standCardView" onclick="changeView('standListView')" style="padding: 5px; border-radius: 10%;  cursor: pointer; color: #333;"></i>
                    </div>
                    <!-- <div class="col-6" style="text-align: right; margin: auto; font-size: 13px;">
                        <i class="fas fa-table catalogCardIcon " id="standCardView" onclick="changeView('standCardView')"></i>
                        <span style="border: 1px solid" class="me-3 ms-1"></span>
                        <i class="far fa-list-alt catalogCardIcon" id="standListView" onclick="changeView('standListView')"></i>
                    </div> -->
                </div>

                <section id="standardCardView" class="showIt">
                    <div class="row m-0">
                        <div class="col-md-4 mb-4">
                            <div style="background:white; border:1px solid #d3d3d3; border-radius:5px; padding: 10px 15px;">
                                <p style="text-decoration:underline; font-size: 12px;white-space: nowrap;"><b>Shifting Distribution List to..</b></p>
                                <div class="row m-0 mb-5">
                                    <p class="p-0" style="cursor: pointer">Shifting Distribution List to Shared Mailboxt</p>
                                </div>
                              

                            </div>
                        </div>
                    </div>
                </section>

                <section id="standardListView" class="hideIt table-responsive">
                    <table class="custom-table-catalog px-2 rounded border" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th style="width:40%;padding:10px;">Item</th>
                                <th style="width:60%;padding:10px;">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="item-td">
                                    <a style="cursor: pointer; color: blue; text-decoration: underline; font-size: 12px">Shifting Distribution List to Shared Mailbox</a>
                                </td>
                                <td class="descrption-td" style="vertical-align: middle;">
                                    <p style="font-size: 12px">Shifting Distribution List to Shared Mailbox</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>

            </div>
        </div>



        <script>
            $(document).ready(function() {
                $('#example').hierarchySelect({
                    hierarchy: false,
                    width: 'auto'
                });
            });

            function changeSideMenu(txt) {
                if (txt == 'infTech') {
                    $('#infTech').addClass('activeCatalog');
                    $('#standChanges').removeClass('activeCatalog');
                    $('#informationTech').addClass('showIt').removeClass('hideIt');
                    $('#standardChanges').addClass('hideIt').removeClass('showIt');
                } else {
                    $('#standChanges').addClass('activeCatalog');
                    $('#infTech').removeClass('activeCatalog');
                    $('#informationTech').addClass('hideIt').removeClass('showIt');
                    $('#standardChanges').addClass('showIt').removeClass('hideIt');
                }
            }

            function changeView(txt) {
                if (txt == 'catCardView') {
                    $('#catCardView').addClass('activeCatalog');
                    $('#catListView').removeClass('activeCatalog');
                    $('#catalogCardView').addClass('showIt').removeClass('hideIt');
                    $('#cataLogListView').addClass('hideIt').removeClass('showIt');
                } else if (txt == 'catListView') {
                    $('#catListView').addClass('activeCatalog');
                    $('#catCardView').removeClass('activeCatalog');
                    $('#catalogCardView').addClass('hideIt').removeClass('showIt');
                    $('#cataLogListView').addClass('showIt').removeClass('hideIt');
                } else if (txt == 'standCardView') {
                    $('#standCardView').addClass('activeCatalog');
                    $('#standListView').removeClass('activeCatalog');
                    $('#standardCardView').addClass('showIt').removeClass('hideIt');
                    $('#standardListView').addClass('hideIt').removeClass('showIt');
                } else if (txt == 'standListView') {
                    $('#standListView').addClass('activeCatalog');
                    $('#standCardView').removeClass('activeCatalog');
                    $('#standardCardView').addClass('hideIt').removeClass('showIt');
                    $('#standardListView').addClass('showIt').removeClass('hideIt');
                }
            }

            function showMoreItems() {
                $('#requestCard').removeClass('hideIt');
                $('#removeCard').removeClass('hideIt');
                $('#showBtnDiv').addClass('hideIt').removeClass('showIt');
            }
        </script>
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('closeModal', function() {
                    $('#yourModal').modal('hide'); // Replace 'yourModal' with the ID of your modal
                });
            });
        </script>