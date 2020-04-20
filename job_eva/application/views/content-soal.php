<div class="page-content">

        
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <h2 class="page-title">Forms</h2>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms.
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
        </li>
    </ul>
    
    <!-- tab kuesioner -->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Basic Example</h5>
                    <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p>
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="custom-control custom-checkbox form-group">
                            <input type="checkbox" class="custom-control-input" id="exampleCheck1">
                            <label class="custom-control-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- tab kuesioner -->
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Basic Example</h5>
                    <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p>
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="custom-control custom-checkbox form-group">
                            <input type="checkbox" class="custom-control-input" id="exampleCheck1">
                            <label class="custom-control-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- tab kuesioner -->
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Basic Example</h5>
                    <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p>
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="custom-control custom-checkbox form-group">
                            <input type="checkbox" class="custom-control-input" id="exampleCheck1">
                            <label class="custom-control-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    

    <div class="row">
        <div class="col-12">
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form controls</h5>
                    <p>Textual form controls—like <code>&lt;input&gt;</code>s, <code>&lt;select&gt;</code>s, and <code>&lt;textarea&gt;</code>s—are styled with the <code>.form-control</code> class. Included are styles for general appearance, focus state, sizing, and more.</p>
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Example select</label>
                            <select class="form-control custom-select" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Example multiple select</label>
                            <select multiple class="form-control custom-select" id="exampleFormControlSelect2">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Example textarea</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Range Inputs</h5>
                    <p>Set horizontally scrollable range inputs using <code>.form-control-range</code>.</p>
                    <form>
                        <div class="form-group">
                            <input type="range" class="custom-range" id="customRange1">

                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Checkboxes and Radios</h5>
                    <p>Checkboxes are for selecting one or several options in a list, while radios are for selecting one option from many.</p>
                    <p>Checkbox example:</p>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="custom-control-label" for="defaultCheck1">
                            Check this box
                        </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" value="" id="defaultCheck2" disabled>
                        <label class="custom-control-label" for="defaultCheck2">
                            Disabled checkbox
                        </label>
                    </div>
                    <p class="m-t-sm">Radio example:</p>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                        <label class="custom-control-label" for="exampleRadios1">
                            Radio #1
                        </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                        <label class="custom-control-label" for="exampleRadios2">
                            Radio #2
                        </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
                        <label class="custom-control-label" for="exampleRadios3">
                            Disabled radio
                        </label>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Groups</h5>
                    <p>The <code>.form-group</code> class is the easiest way to add some structure to forms. It provides a flexible class that encourages proper grouping of labels, controls, optional help text, and form validation messaging.</p>
                    <form>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Example label</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Another label</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Grid</h5>
                    <p>More complex forms can be built using our grid classes. Use these for form layouts that require multiple columns, varied widths, and additional alignment options.</p>
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="input1">First name</label>
                                    <input type="text" class="form-control" placeholder="First name" id="input1">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="input2">Last name</label>
                                    <input type="text" class="form-control" placeholder="Last name" id="input2">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Complex Layout</h5>
                    <p>More complex layouts can also be created with the grid system.</p>
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Password</label>
                                <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Address 2</label>
                            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control custom-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Zip</label>
                                <input type="text" class="form-control" id="inputZip">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="gridCheck">
                                <label class="custom-control-label" for="gridCheck">
                                    Check me out
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Validation</h5>
                    <p>Provide valuable, actionable feedback to your users with HTML5 form validation.</p>
                    <form class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="validationCustom01">First name</label>
                                    <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="validationCustom02">Last name</label>
                                    <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        </div>
                                        <label for="validationCustomUsername">Username</label>
                                        <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                                        <div class="invalid-feedback">
                                            Please choose a username.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="validationCustom03">City</label>
                                    <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid city.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="validationCustom04">State</label>
                                    <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="validationCustom05">Zip</label>
                                    <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid zip.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" value="" id="invalidCheck" required>
                                    <label class="custom-control-label" for="invalidCheck">
                                        Agree to terms and conditions
                                    </label>
                                    <div class="invalid-feedback">
                                        You must agree before submitting.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Switches</h5>
                    <p>A switch has the markup of a custom checkbox but uses the <code>.custom-switch</code> class to render a toggle switch. Switches also support the <code>disabled</code> attribute.</p>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1">Toggle this switch element</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" disabled id="customSwitch2">
                        <label class="custom-control-label" for="customSwitch2">Disabled switch element</label>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Select</h5>
                    <p>Custom <code>&lt;select&gt;</code> menus need only a custom class, <code>.custom-select</code> to trigger the custom styles. Custom styles are limited to the <code>&lt;select&gt;</code>’s initial appearance and cannot modify the <code>&lt;option&gt;</code>s due to browser limitations.</p>
                    <select class="custom-select form-control">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
        
        
</div><!-- Page Content -->
    <script type="text/javascript">

    $(document).ready(function() {

        $("#display").click(function() {     
            var url = "<?php echo base_url(); ?>index.php/home/soalshow";
            $.ajax({    //create an ajax request to display.php
                type: "POST",
                url: url,             
                dataType: "json",   //expect html to be returned                
                success: function(response){                    
                    $('#soal').html(response.soal); //hold the response in id and show on popup
                }

            });
        });
    });

    </script>