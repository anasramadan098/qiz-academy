<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('adds')
        <link rel="stylesheet" href="css/register.css">
    @endsection
<body>
    @include('components.header')

    <div class="bg">
        <h1>Globally Certified Professionals</h1>
    </div>
    <section class="text">
        <span class="nav">
            <a href="/">Home</a> / Home Globally Certified Professionals
        </span>
        <h3>GAQM Online Credential Registry</h3>
        <p>The GAQM Online Credential Registry enables verification of GAQM Certification and Diploma holders. To find a credential holder in the registry, please input the certificate number and name exactly as it appears on the E-Certificate or Hard Copy certificate. It's important to note that appearing in the registry requires achieving a qualified score.</p>
        <p>The Candidate Registry is typically updated within two (2) working days from when the candidate attains a qualified score on the exam. GAQM Certification Exams are administered globally through ProctorU or GAQM Authorized Testing Centers.        </p>
        <p>Please be aware that the Candidate Registry only includes records of candidates who have achieved a qualified score in the exam.        </p>
        <form action="/register" method="post" class="d-flex">
            <h3>Enter Certification Details :</h3>
            <div class="inputs">
                <input type="number" name="certificate_number" placeholder="Enter Your Certificate Number...">
                <input type="text" name="certificate_name" placeholder="Enter Your Name as on Certificate...">    
            </div>
            <button type="submit" class="btn">Submit</button>
        </form>
    </section>



        @extends('components.footer')

        <script src="../js/main.js"></script>
</body>
</html>





    

