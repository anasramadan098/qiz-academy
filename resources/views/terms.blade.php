

<!DOCTYPE html>
<html lang="en">
<head>
    @extends('components.head')
    @section('adds')
        <link rel="stylesheet" href="css/register.css">
        <style>
            .bg {
                background-image: url("https://gaqm.org/assets/img/banner/banner15.jpg");
            }
        </style>
    @endsection

</head>
<body>
    @include('components.header')
    <div class="bg">
        <h1>Terms and Conditions </h1>
    </div>
    <section class="text">
        <span class="nav">
            <a href="/">Home</a> / Terms and Conditions 
        </span>
        <h3>Terms and Conditions </h3>
        <p>
            Welcome to our E-Learning Website! Before you start exploring our platform, please read these terms and conditions carefully. By accessing or using our website, you agree to abide by these terms and conditions.
        </p>
        <p>
            1. Accuracy of Content: While we strive to provide accurate and up-to-date information, we cannot guarantee the accuracy, completeness, or reliability of any content on this website, including course materials, certificates, and course names. Any similarity between our certificates or course content and those of other entities is purely coincidental.
            <p>
            What sets us apart is our commitment to quality education and user-centric learning experiences. We offer interactive modules, comprehensive study materials, and ongoing support to help you succeed on your learning journey. Our community of learners is diverse and inclusive, fostering collaboration and knowledge-sharing among peers.
        </p>
        <p>
            2. Content Ownership: All content on this website, including course materials, certificates, and course names, is created and owned by our website. We reserve all rights to this content. Reproduction, distribution, or modification of any content from this website without prior written consent is strictly prohibited.
        </p>
        <p>
            3. Third-Party Accreditation: We do not guarantee accreditation by any third party for the content, certificates, or courses offered on this website. While we may provide information about accreditation where applicable, it is your responsibility to verify the accreditation status with the relevant accrediting bodies.
        </p>
        <p>
            4. Use of Website: You agree to use this website for lawful purposes only and in a manner that does not infringe upon the rights of others. You may not use this website to engage in any activity that is illegal, harmful, or violates the rights of others.
        </p>
        <p>
            5. User Accounts: In order to access certain features of our website, you may be required to create a user account. You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.
        </p>
        <p>
            6. Limitation of Liability: We shall not be liable for any direct, indirect, incidental, special, or consequential damages arising out of your use of or inability to use this website, including but not limited to damages for loss of profits, data, or other intangible losses.
        </p>
        <p>
            7. Changes to Terms: We reserve the right to modify or update these terms and conditions at any time without prior notice. Your continued use of the website after any such changes constitutes your acceptance of the new terms.
        </p>
        <p>
            8. Contact Us: If you have any questions or concerns about these terms and conditions, please contact us at <a href="/contact-us">This Link</a>.
        </p>
        <p>
            By accessing or using our website, you acknowledge that you have read, understood, and agree to be bound by these terms and conditions. If you do not agree with any part of these terms, you may not access or use our website.
        </p>
    
    </section>



        @extends('components.footer')

        <script src="{{asset('js/main.js')}}"></script>
</body>
</html>