<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('adds')
        <link rel="stylesheet" href="css/contact.css">
    @endsection
<body>
    @include('components.header')

    <div class="bg">
        <h1>Contact Us</h1>
    </div>   
    <section>
        <span>
            <a href="/">Home</a> / Contact Us
        </span>
        <div class="holder">
            <form >
                <h3>Contact Form</h3>
                
                <h4>I am a <span class="required">*</span></h4>
                <div class="input">
                    <input type="radio" required name="person_type" value="candidate" id="Candidate">
                    <label for="Candidate">Candidate</label>
                </div>
                <div class="input">
                    <input type="radio" required name="person_type" value="training_organization" id="Training organization">
                    <label for="Training organization">Training organization</label>
                </div>
                <div class="input">
                    <input type="radio" required name="person_type" value="corporation" id="corporation">
                    <label for="corporation">Corporation</label>
                </div>
                <div class="input">
                    <input type="radio" required name="person_type" value="other" id="other">
                    <label for="other">Other</label>
                </div>
                <input type="text" required style="display: none;" class="other" name="person_type" placeholder="other">
                <h4>Title <span class="required">*</span></h4>
                <div class="input">
                    <input type="radio" required name="gender" id="Mr" value="mr">
                    <label for="Mr">Mr</label>
                    <span>/</span>
                    <input type="radio" required name="gender" id="Mrs" value="mrs">
                    <label for="Mrs">Mrs</label>
                </div>


                <div class="full-input">
                    <h5>Full Name <span class="required">*</span> </h5>
                    <input type="text" required name="first_name" placeholder="First Name">
                </div>

                <div class="full-input">
                    <h5>Last Name <span class="required">*</span></h5>
                    <input type="text" required name="last_name" placeholder="Last Name">
                </div>

                <div class="full-input">
                    <h5>Email Name <span class="required">*</span></h5>
                    <input type="text" required name="email" placeholder="Email">
                </div>

                <div class="full-input">
                    <h5>Contact Phone <span class="required">*</span></h5>
                    <input type="text" required name="phone" placeholder="Contact Phone">
                </div>

                <div class="full-input">
                    <h5>Organization / Corporation <span class="required">*</span></h5>
                    <input type="text" required name="organization" placeholder="Organization / Corporation">
                </div>

                <div class="full-input">
                    <h5>Position <span class="required">*</span></h5>
                    <input type="text" required name="organization" placeholder="Position">
                </div>

                <div class="full-input">
                    <h5>Address <span class="required">*</span></h5>
                    <input type="text" required name="address" placeholder="Address">
                </div>

                <div class="full-input">
                    <h5>ZIP Code <span class="required">*</span></h5>
                    <input type="text" required name="zip" placeholder="Zip Code">
                </div>

                <div class="full-input">
                    <h5>City <span class="required">*</span></h5>
                    <input type="text" required name="city" placeholder="City">
                </div>

                <div class="full-input">
                    <h5>Issue Description <span class="required">*</span></h5>
                    <textarea name="description" required placeholder="Issue Description"></textarea>
                </div>

                <div class="btns">
                    <input type="reset" class="btn" value="Clear">
                    <input type="submit" class="btn" value="Submit">
                </div>

            </form>
            <div class="text">

            </div>
        </div>
    </section>



        @extends('components.footer')

        <script>
            const otherInput = document.querySelector('.other');
            document.querySelectorAll('input[name="person_type"]').forEach(input => {
                input.addEventListener('change',() => {
                    if (input.value == 'other') {
                        otherInput.style.display = 'block';
                        otherInput.required = true;
                    } else {
                        otherInput.style.display = 'none';
                        otherInput.required = false;
                    }
                })
            }) 
        </script>
        <script src="../js/main.js"></script>
</body>
</html>





    

