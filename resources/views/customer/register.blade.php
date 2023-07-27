<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

    <!-- Bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/login.css') }}">
    
    <title>Register</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <style>
        .eye-icon-position {
            display: block;
            margin-top: -53px;
            float: right;
            margin-right: 10px;
        }
    </style>    

</head>

<body class="user-select-none">
    <div id="particles-js"></div>
    <div class="container-fluid">    
        <div class="row align-items-center vh-100">
            <div class="col-10 mx-auto">
                <div class="card shadow border">
                    <div class="row gx-0">
                        <div class="col-md-3 login-col1 p-3">
                            <div class="">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="mt-5 img-fluid border border-5 border-white mx-auto d-block" style="padding: 1px; width: 120px;">
                                <h5 class="fw-bold text-center text-white lh-base pt-4">{{ env('APP_NAME') }} Clinic</h5>
                            </div>
                        </div>
                        <div class="col-md-9 login-col">
                            <h5 class="fw-bold text-center pt-4 login-title pb-2">Customer Register</h5>
                            <div class="mx-5">
                                <div class="flash-container">
                                   {{--   @if(Session::has('error'))
                                        <p class="p-2 bg-danger text-white">
                                            {{Session::get('error')}}
                                        </p>
                                     @endif --}}
                                </div>
                                <!-- Input Fields -->
                                <div class="row my-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control my-2" id="first_name" placeholder="Enter first name" aria-label="First name">
                                            <div class="invalid-feedback first-name-error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middle_name">Middle Name</label>
                                            <input type="text" class="form-control my-2" id="middle_name" placeholder="Enter middle name" aria-label="Middle Name">
                                            <div class="invalid-feedback middle-name-error"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control my-2" id="last_name" placeholder="Enter last name" aria-label="Last Name">
                                            <div class="invalid-feedback last-name-error"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sex">Sex</label>
                                            <select class="form-control my-2" id="sex">
                                                <option disabled selected>Select sex</option>
                                                <option value="0">Male</option>
                                                <option value="1">Female</option>
                                            </select>
                                            <div class="invalid-feedback sex-error"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email_address">Email Address</label>
                                            <input type="text" class="form-control my-2" id="email_address" placeholder="Enter email" aria-label="Email">
                                            <div class="invalid-feedback email-address-error"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control my-2" id="username" placeholder="Enter username" aria-label="Username">
                                            <div class="invalid-feedback username-error"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row my-2">
                                    <div class="col-md-4">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control my-2 mb-4" id="password" placeholder="Enter password" aria-label="Password">
                                        <span class="show eye-icon-position">
                                            <i class="las la-eye fs-5" id="show1" onclick="toggle1()"></i> 
                                        </span>
                                        <div class="invalid-feedback password-error"></div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" class="form-control my-2 mb-4" id="confirm_password" placeholder="Enter password again" aria-label="Confirm Password">
                                        <span class="show eye-icon-position">
                                            <i class="las la-eye fs-5" id="show2" onclick="toggle2()"></i>
                                        </span>
                                        <div class="invalid-feedback confirm-password-error"></div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="contact_no">Contact Number</label>
                                        <input type="number" class="form-control my-2 mb-4" id="contact_no" placeholder="Enter contact number" aria-label="Contact Number">
                                        <div class="invalid-feedback contact-no-error"></div>
                                    </div>
                                </div>
                                
                                <div class="row my-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address">Complete Address</label>
                                            <input type="text" class="form-control my-2" id="address" placeholder="Enter address" aria-label="Complete Address">
                                            <div class="invalid-feedback address-error"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Captcha Image -->
                                <label for="captcha">Captcha</label>
                                <br>
                                <small class="text-secondary" style="font-size: 11px;">Just to prove you are a human, please answer the math equation.</small>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="invalid-feedback captcha-error"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="captcha_container mb-1">
                                            {!! captcha_img() !!}
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control mb-2" id="captcha" placeholder="Enter answer" aria-label="Captcha">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="btn_reload">
                                                    <i class="las la-sync"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="agreement">
                                            <label class="form-check-label">
                                                <a id="read_agreement" type="button" href="javascript:void(0)" data-toggle="modal" data-target="#agreementModal" style="text-decoration: none;" class="text-primary">I have read and agreed to the terms and condition</a>
                                            </label>
                                        </div>
                                        <span class="agreement-error text-danger" style="display:none;">Please agree to all the terms and condition</span>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between mt-3">
                                    <!-- Register -->
                                    <a href="{{ url('/customer/login') }}" class="forgot-pass">Have an account? Login</a>
                                    <!-- Forgot Password -->
                                    <a href="{{ url('/customer/forgot-password') }}" class="forgot-pass">Forgot Password?</a>
                                </div>
                            </div>

                            <!-- Register Button -->
                            <button class="text-center mx-auto d-block loginBtn py-2 px-5 my-3 fw-bold text-white" id="btn_register">Register</button>

                            <!-- Copyright -->
                            <p class="copyright text-center">Copyright &copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Agreement Modal --}}
    <div class="modal fade" id="agreementModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms and Agreement</h5>
                </div>
                <div class="modal-body">
                    

                    <div class="block block0 col-xs-12 text-justify"><div class="wturor-0 fnBaeO"><h2>Terms of Use</h2><p><b>Acceptance of the Terms of Use</b></p><p>These terms of use are entered into by and between You and the name of the Company that appears on the first page of this website (”<b>Company</b>”, “<b>we</b>”, or “<b>us</b>”). The following terms and conditions, together with any documents they expressly incorporate by reference (collectively, these “<b>Terms of Use</b>”), govern your access to and use of this website, including any content, functionality, and services offered on or through this website (the “<b>Website</b>”).</p><p>Please read the Terms of Use carefully before you start to use the Website. <b>By using the Website you accept and agree to be bound and abide by these Terms of Use and our Privacy Policy, incorporated herein by reference.</b> If you do not want to agree to these Terms of Use or the Privacy Policy, you must not access or use the Website.</p><p>This Website is offered and available to users who are 18 years of age or older and reside in the Philippines or any of its territories or possessions. By using this Website, you represent and warrant that you are of legal age to form a binding contract with the Company and meet all of the foregoing eligibility requirements. If you do not meet all of these requirements, you must not access or use the Website.</p><p><b>Changes to the Terms of Use</b></p><p>We may revise and update these Terms of Use from time to time in our sole discretion. All changes are effective immediately when we post them, and apply to all access to and use of the Website thereafter.</p><p>Your continued use of the Website following the posting of revised Terms of Use means that you accept and agree to the changes. You are expected to check this page each time you access this Website so you are aware of any changes, as they are binding on you.</p><p><b>Accessing the Website and Account Security</b></p><p>We reserve the right to withdraw or amend this Website, and any service or material we provide on the Website, in our sole discretion without notice. We will not be liable if for any reason all or any part of the Website is unavailable at any time or for any period. From time to time, we may restrict access to some parts of the Website, or the entire Website, to users, including registered users.You are responsible for:</p><ul><li><p>Making all arrangements necessary for you to have access to the Website.</p></li><li><p>Ensuring that all persons who access the Website through your internet connection are aware of these Terms of Use and comply with them.</p></li></ul><p>It is a condition of your use of the Website that all the information you provide on the Website is correct, current, and complete. You agree that all information you provide to register with this Website or otherwise, including but not limited to through the use of any interactive features on the Website, is governed by our Privacy Policy, and you consent to all actions we take with respect to your information consistent with our Privacy Policy.</p><p><b>Intellectual Property Rights</b></p><p>The Website and its entire contents, features, and functionality (including but not limited to all information, software, text, displays, images, video, and audio, and the design, selection, and arrangement thereof) are owned by the Company, its licensors, or other providers of such material and are protected by Philippines and international copyright, trademark, patent, trade secret, and other intellectual property or proprietary rights laws.</p><p>These Terms of Use permit you to use the Website for your personal, non-commercial use only. You must not reproduce, distribute, modify, create derivative works of, publicly display, publicly perform, republish, download, store, or transmit any of the material on our Website, except as follows:</p><ul><li><p>Your computer may temporarily store copies of such materials in RAM incidental to your accessing and viewing those materials.</p></li><li><p>You may store files that are automatically cached by your Web browser for display enhancement purposes.</p></li><li><p>You may print one copy of a reasonable number of pages of the Website for your own personal, non-commercial use and not for further reproduction, publication, or distribution.</p></li><li><p>If we provide desktop, mobile, or other applications for download, you may download a single copy to your computer or mobile device solely for your own personal, non-commercial use, provided you agree to be bound by our end user license agreement for such applications.</p></li><li><p>If we provide social media features with certain content, you may take such actions as are enabled by such features.</p></li></ul><p>You must not:</p><ul><li><p>Modify copies of any materials from this site.</p></li><li><p>Use any illustrations, photographs, video or audio sequences, or any graphics separately from the accompanying text.</p></li><li><p>Delete or alter any copyright, trademark, or other proprietary rights notices from copies of materials from this site.</p></li></ul><p>You must not access or use for any commercial purposes any part of the Website or any services or materials available through the Website.</p><p>If you wish to make any use of material on the Website other than that set out in this section, please address your request to the email address set forth on the first page on this webpage.</p><p>If you print, copy, modify, download, or otherwise use or provide any other person with access to any part of the Website in breach of the Terms of Use, your right to use the Website will stop immediately and you must, at our option, return or destroy any copies of the materials you have made. No right, title, or interest in or to the Website or any content on the Website is transferred to you, and all rights not expressly granted are reserved by the Company. Any use of the Website not expressly permitted by these Terms of Use is a breach of these Terms of Use and may violate copyright, trademark, and other laws.</p><p><b>Trademarks</b></p><p>The Company name and the Company logo, and all related names, logos, product and service names, designs, and slogans are trademarks of the Company or its affiliates or licensors. You must not use such marks without the prior written permission of the Company. All other names, logos, product and service names, designs, and slogans on this Website are the trademarks of their respective owners.</p><p><b>Prohibited Uses</b></p><p>You may use the Website only for lawful purposes and in accordance with these Terms of Use. You agree not to use the Website:</p><ul><li><p>In any way that violates any applicable federal, state, local, or international law or regulation (including, without limitation, any laws regarding the export of data or software to and from the US or other countries).</p></li><li><p>For the purpose of exploiting, harming, or attempting to exploit or harm minors in any way by exposing them to inappropriate content, asking for personally identifiable information, or otherwise.</p></li><li><p>To transmit, or procure the sending of, any advertising or promotional material, including any “junk mail”, “chain letter”, “spam”, or any other similar solicitation.</p></li><li><p>To impersonate or attempt to impersonate the Company, a Company employee, another user, or any other person or entity (including, without limitation, by using email addresses associated with any of the foregoing).</p></li><li><p>To engage in any other conduct that restricts or inhibits anyone’s use or enjoyment of the Website, or which, as determined by us, may harm the Company or users of the Website or expose them to liability.</p></li></ul><p>Additionally, you agree not to:</p><ul><li><p>Use the Website in any manner that could disable, overburden, damage, or impair the site or interfere with any other party’s use of the Website, including their ability to engage in real time activities through the Website.</p></li><li><p>Use any robot, spider, or other automatic device, process, or means to access the Website for any purpose, including monitoring or copying any of the material on the Website.</p></li><li><p>Use any manual process to monitor or copy any of the material on the Website or for any other unauthorized purpose without our prior written consent.</p></li><li><p>Use any device, software, or routine that interferes with the proper working of the Website.</p></li><li><p>Introduce any viruses, Trojan horses, worms, logic bombs, or other material that is malicious or technologically harmful.</p></li><li><p>Attempt to gain unauthorized access to, interfere with, damage, or disrupt any parts of the Website, the server on which the Website is stored, or any server, computer, or database connected to the Website.Attack the Website via a denial-of-service attack or a distributed denial-of-service attack.</p></li><li><p>Otherwise attempt to interfere with the proper working of the Website.</p></li><li><p>Attack the Website via a denial-of-service attack or a distributed denial-of-service attack.</p></li></ul><p><b>Monitoring and Enforcement; Termination</b></p><p>We have the right to:</p><ul><li><p>Take appropriate legal action, including without limitation, referral to law enforcement, for any illegal or unauthorized use of the Website.</p></li><li><p>Terminate or suspend your access to all or part of the Website for any or no reason, including without limitation, any violation of these Terms of Use.</p></li></ul><p>Without limiting the foregoing, we have the right to cooperate fully with any law enforcement authorities or court order requesting or directing us to disclose the identity or other information of anyone posting any materials on or through the Website. YOU WAIVE AND HOLD HARMLESS THE COMPANY AND ITS AFFILIATES, LICENSEES, AND SERVICE PROVIDERS FROM ANY CLAIMS RESULTING FROM ANY ACTION TAKEN BY THE COMPANY/ANY OF THE FOREGOING PARTIES DURING, OR TAKEN AS A CONSEQUENCE OF, INVESTIGATIONS BY EITHER THE COMPANY/SUCH PARTIES OR LAW ENFORCEMENT AUTHORITIES.</p><p>We assume no liability for any action or inaction regarding transmissions, communications, or content provided by any user or third party. We have no liability or responsibility to anyone for performance or nonperformance of the activities described in this section.</p><p><b>Reliance on Information Posted</b></p><p>The information presented on or through the Website is made available solely for general information purposes. We do not warrant the accuracy, completeness, or usefulness of this information. Any reliance you place on such information is strictly at your own risk. We disclaim all liability and responsibility arising from any reliance placed on such materials by you or any other visitor to the Website, or by anyone who may be informed of any of its contents.</p><p>This Website may include content provided by third parties, including materials provided by other users, bloggers, and third-party licensors, syndicators, aggregators, and/or reporting services. All statements and/or opinions expressed in these materials, and all articles and responses to questions and other content, other than the content provided by the Company, are solely the opinions and the responsibility of the person or entity providing those materials. These materials do not necessarily reflect the opinion of the Company. We are not responsible, or liable to you or any third party, for the content or accuracy of any materials provided by any third parties.</p><p><b>Changes to the Website</b></p><p>We may update the content on this Website from time to time, but its content is not necessarily complete or up-to-date. Any of the material on the Website may be out of date at any given time, and we are under no obligation to update such material.</p><p><b>Information About You and Your Visits to the Website</b></p><p>All information we collect on this Website is subject to our Privacy Policy. By using the Website, you consent to all actions taken by us with respect to your information in compliance with the Privacy Policy.</p><p><b>Linking to the Website and Social Media Features</b></p><p>You may link to our homepage, provided you do so in a way that is fair and legal and does not damage our reputation or take advantage of it, but you must not establish a link in such a way as to suggest any form of association, approval, or endorsement on our part without our express written consent.</p><p>This Website may provide certain social media features that enable you to:</p><ul><li><p>Link from your own or certain third-party websites to certain content on this Website.</p></li><li><p>Send emails or other communications with certain content, or links to certain content, on this Website.</p></li><li><p>Cause limited portions of content on this Website to be displayed or appear to be displayed on your own or certain third-party websites.</p></li></ul><p>You may use these features solely as they are provided by us and solely with respect to the content they are displayed with and otherwise in accordance with any additional terms and conditions we provide with respect to such features. Subject to the foregoing, you must not:</p><ul><li><p>Establish a link from any website that is not owned by you.</p></li><li><p>Cause the Website or portions of it to be displayed on, or appear to be displayed by, any other site, for example, framing, deep linking, or in-line linking.</p></li><li><p>Link to any part of the Website other than the homepage.</p></li><li><p>Otherwise take any action with respect to the materials on this Website that is inconsistent with any other provision of these Terms of Use.</p></li></ul><p>The website from which you are linking, or on which you make certain content accessible, must comply in all respects with the Content Standards set out in these Terms of Use.</p><p>You agree to cooperate with us in causing any unauthorized framing or linking immediately to stop. We reserve the right to withdraw linking permission without notice.</p><p>We may disable all or any social media features and any links at any time without notice in our discretion.</p><p><b>Links from the Website</b></p><p>If the Website contains links to other sites and resources provided by third parties, these links are provided for your convenience only. This includes links contained in advertisements, including banner advertisements and sponsored links. We have no control over the contents of those sites or resources, and accept no responsibility for them or for any loss or damage that may arise from your use of them. If you decide to access any of the third-party websites linked to this Website, you do so entirely at your own risk and subject to the terms and conditions of use for such websites.</p><p><b>Geographic Restrictions</b></p><p>We provide this Website for use only by persons located in the Philippines. We make no claims that the Website or any of its content is accessible or appropriate outside of the Philippines. Access to the Website may not be legal by certain persons or in certain countries. If you access the Website from outside the Philippines, you do so on your own initiative and are responsible for compliance with local laws.</p><p><b>Disclaimer of Warranties</b></p><p>You understand that we cannot and do not guarantee or warrant that files available for downloading from the internet or the Website will be free of viruses or other destructive code. You are responsible for implementing sufficient procedures and checkpoints to satisfy your particular requirements for anti-virus protection and accuracy of data input and output, and for maintaining a means external to our site for any reconstruction of any lost data. TO THE FULLEST EXTENT PROVIDED BY LAW, WE WILL NOT BE LIABLE FOR ANY LOSS OR DAMAGE CAUSED BY A DISTRIBUTED DENIAL-OF-SERVICE ATTACK, VIRUSES, OR OTHER TECHNOLOGICALLY HARMFUL MATERIAL THAT MAY INFECT YOUR COMPUTER EQUIPMENT, COMPUTER PROGRAMS, DATA, OR OTHER PROPRIETARY MATERIAL DUE TO YOUR USE OF THE WEBSITE OR ANY SERVICES OR ITEMS OBTAINED THROUGH THE WEBSITE OR TO YOUR DOWNLOADING OF ANY MATERIAL POSTED ON IT, OR ON ANY WEBSITE LINKED TO IT.</p><p>YOUR USE OF THE WEBSITE, ITS CONTENT, AND ANY SERVICES OR ITEMS OBTAINED THROUGH THE WEBSITE IS AT YOUR OWN RISK. THE WEBSITE, ITS CONTENT, AND ANY SERVICES OR ITEMS OBTAINED THROUGH THE WEBSITE ARE PROVIDED ON AN “AS IS” AND “AS AVAILABLE” BASIS, WITHOUT ANY WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED. NEITHER THE COMPANY NOR ANY PERSON ASSOCIATED WITH THE COMPANY MAKES ANY WARRANTY OR REPRESENTATION WITH RESPECT TO THE COMPLETENESS, SECURITY, RELIABILITY, QUALITY, ACCURACY, OR AVAILABILITY OF THE WEBSITE. WITHOUT LIMITING THE FOREGOING, NEITHER THE COMPANY NOR ANYONE ASSOCIATED WITH THE COMPANY REPRESENTS OR WARRANTS THAT THE WEBSITE, ITS CONTENT, OR ANY SERVICES OR ITEMS OBTAINED THROUGH THE WEBSITE WILL BE ACCURATE, RELIABLE, ERROR-FREE, OR UNINTERRUPTED, THAT DEFECTS WILL BE CORRECTED, THAT OUR SITE OR THE SERVER THAT MAKES IT AVAILABLE ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS, OR THAT THE WEBSITE OR ANY SERVICES OR ITEMS OBTAINED THROUGH THE WEBSITE WILL OTHERWISE MEET YOUR NEEDS OR EXPECTATIONS.TO THE FULLEST EXTENT PROVIDED BY LAW, THE COMPANY HEREBY DISCLAIMS ALL WARRANTIES OF ANY KIND, WHETHER EXPRESS OR IMPLIED, STATUTORY, OR OTHERWISE, INCLUDING BUT NOT LIMITED TO ANY WARRANTIES OF MERCHANTABILITY, NON-INFRINGEMENT, AND FITNESS FOR PARTICULAR PURPOSE.THE FOREGOING DOES NOT AFFECT ANY WARRANTIES THAT CANNOT BE EXCLUDED OR LIMITED UNDER APPLICABLE LAW.</p><p><b>Limitation on Liability</b></p><p>TO THE FULLEST EXTENT PROVIDED BY LAW, IN NO EVENT WILL THE COMPANY, ITS AFFILIATES, OR THEIR LICENSORS, SERVICE PROVIDERS, EMPLOYEES, AGENTS, OFFICERS, OR DIRECTORS BE LIABLE FOR DAMAGES OF ANY KIND, UNDER ANY LEGAL THEORY, ARISING OUT OF OR IN CONNECTION WITH YOUR USE, OR INABILITY TO USE, THE WEBSITE, ANY WEBSITES LINKED TO IT, ANY CONTENT ON THE WEBSITE OR SUCH OTHER WEBSITES, INCLUDING ANY DIRECT, INDIRECT, SPECIAL, INCIDENTAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES, INCLUDING BUT NOT LIMITED TO, PERSONAL INJURY, PAIN AND SUFFERING, EMOTIONAL DISTRESS, LOSS OF REVENUE, LOSS OF PROFITS, LOSS OF BUSINESS OR ANTICIPATED SAVINGS, LOSS OF USE, LOSS OF GOODWILL, LOSS OF DATA, AND WHETHER CAUSED BY TORT (INCLUDING NEGLIGENCE), BREACH OF CONTRACT, OR OTHERWISE, EVEN IF FORESEEABLE. THE FOREGOING DOES NOT AFFECT ANY LIABILITY THAT CANNOT BE EXCLUDED OR LIMITED UNDER APPLICABLE LAW.</p><p><b>Indemnification</b></p><p>You agree to defend, indemnify, and hold harmless the Company, its affiliates, licensors, and service providers, and its and their respective officers, directors, employees, contractors, agents, licensors, suppliers, successors, and assigns from and against any claims, liabilities, damages, judgments, awards, losses, costs, expenses, or fees (including reasonable attorneys’ fees) arising out of or relating to your violation of these Terms of Use or your use of the Website, including, but not limited to, your User Contributions, any use of the Website’s content, services, and products other than as expressly authorized in these Terms of Use or your use of any information obtained from the Website.</p><p><b>Governing Law and Jurisdiction</b></p><p>All matters relating to the Website and these Terms of Use and any dispute or claim arising therefrom or related thereto (in each case, including non-contractual disputes or claims), shall be governed by and construed in accordance with the internal laws of the Metro Manila without giving effect to any choice or conflict of law provision or rule (whether of the Metro Manila or any other jurisdiction).</p><p><b>Limitation on Time to File Claims</b></p><p>ANY CAUSE OF ACTION OR CLAIM YOU MAY HAVE ARISING OUT OF OR RELATING TO THESE TERMS OF USE OR THE WEBSITE MUST BE COMMENCED WITHIN ONE (1) YEAR AFTER THE CAUSE OF ACTION ACCRUES, OTHERWISE, SUCH CAUSE OF ACTION OR CLAIM IS PERMANENTLY BARRED.</p><p><b>Waiver and Severability</b></p><p>No waiver by the Company of any term or condition set out in these Terms of Use shall be deemed a further or continuing waiver of such term or condition or a waiver of any other term or condition, and any failure of the Company to assert a right or provision under these Terms of Use shall not constitute a waiver of such right or provision.If any provision of these Terms of Use is held by a court or other tribunal of competent jurisdiction to be invalid, illegal, or unenforceable for any reason, such provision shall be eliminated or limited to the minimum extent such that the remaining provisions of the Terms of Use will continue in full force and effect.</p><p><b>Entire Agreement</b></p><p>The Terms of Use and our Privacy Policy constitute the sole and entire agreement between you and Company regarding the Website and supersede all prior and contemporaneous understandings, agreements, representations, and warranties, both written and oral, regarding the Website.</p><p><b>Your Comments and Concerns</b></p><p>All other feedback, comments, requests for technical support, and other communications relating to the Website should be directed to the email address provided on the first page this webpage.</p></div></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary close" data-dismiss="modal" id="btn_agree">Agree</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        var state1 = false;
        var state2 = false;

        let hide1 = document.querySelector("#show1");
        let hide2 = document.querySelector("#show2");

        $(document).ready(function() {
            $('.agreement-error').hide();
        })

        function toggle1() {
            if (state1) {
                document.getElementById("password").setAttribute("type", "password");
                hide1.style.color = "#D0CECE";
                hide1.classList.replace("la-eye-slash", "la-eye");
                state1 = false;
            } else {
                document.getElementById("password").setAttribute("type", "text");
                hide1.style.color = "#1976D2";
                hide1.classList.replace("la-eye", "la-eye-slash");
                state1 = true;
            }
        }

        function toggle2() {
            if (state2) {
                document.getElementById("confirm_password").setAttribute("type", "password");
                hide2.style.color = "#D0CECE";
                hide2.classList.replace("la-eye-slash", "la-eye");
                state2 = false;
            } else {
                document.getElementById("confirm_password").setAttribute("type", "text");
                hide2.style.color = "#1976D2";
                hide2.classList.replace("la-eye", "la-eye-slash");
                state2 = true;
            }
        }

        $(document).on('click', '#btn_reload', function() {
            var url = "{{ url('/customer/reload-captcha') }}"

            axios.get(url)
            .then(function(response) {
                $('.captcha_container').html(response.data.captcha)
            })
        })

  
        $('#first_name').on('keypress', function(event) {
            var inputValue = event.key;

            if(!/^[a-zA-Z'\-]+$/.test(inputValue)) {
                event.preventDefault();
            }
        });

        $('#middle_name').on('keypress', function(event) {
            var inputValue = event.key;

            if(!/^[a-zA-Z'\-]+$/.test(inputValue)) {
                event.preventDefault();
            }
        });

        $('#last_name').on('keypress', function(event) {
            var inputValue = event.key;

            if(!/^[a-zA-Z'\-]+$/.test(inputValue)) {
                event.preventDefault();
            }
        });

        $(document).on('keypress', '#username', function(e) {
            if (e.keyCode == "13") {
                register()
            }
        })

        $(document).on('keypress', '#password', function(e) {
            if (e.keyCode == "13") {
                register()
            }
        })

        $(document).on('keypress', '#captcha', function(e) {
            if (e.keyCode == "13") {
                register()
            }
        })

        $(document).on('click', '#read_agreement', function() {
            $('#agreementModal').modal('show')
        })

        $(document).on('click', '#btn_agree', function() {
            $('#agreement').prop('checked', true)
            $('#agreementModal').modal('hide')
        })

        $(document).on('click', '#btn_register', function(e) {
            register(e)
        })

        function register(e) {
            var url = "{{ url('/customer/register') }}"
            var payload = {
                _token: "{{ csrf_token() }}",
                first_name: $('#first_name').val(),
                middle_name: $('#middle_name').val(),
                last_name: $('#last_name').val(),
                sex: $('#sex').val(),
                email_address: $('#email_address').val(),
                username: $('#username').val(),
                password: $('#password').val(),
                password_confirmation: $('#confirm_password').val(),
                contact_no: $('#contact_no').val(),
                address: $('#address').val(),
                captcha: $('#captcha').val(),
            }

            if ($('#agreement').is(':checked')) {
                $('.agreement-error').hide()
            
                axios.post(url, payload)
                .then(function(response) {
                    if (response.data.code == 422) {
                        var errors = response.data.error
                        for (var i = 0; i < errors.length; i++) {
                            var first_name_error       = errors[i].indexOf('first') !== -1
                            var last_name_error        = errors[i].indexOf('last') !== -1
                            var sex_error           = errors[i].indexOf('sex') !== -1
                            var email_error            = errors[i].indexOf('email') !== -1
                            var username_error         = errors[i].indexOf('username') !== -1
                            var password_error         = errors[i].indexOf('password') !== -1
                            var confirm_password_error = errors[i].indexOf('confirmation') !== -1
                            var contact_error          = errors[i].indexOf('contact') !== -1
                            var address_error          = errors[i].indexOf('address') !== -1
                            var captcha_error          = errors[i].indexOf('captcha') !== -1

                            if (first_name_error) {
                                $('#first_name').addClass('is-invalid')
                                $('.first-name-error').show().text(errors[i])
                                break
                            } else {
                                $('#first_name').removeClass('is-invalid')
                                $('.first-name-error').hide()
                            }

                            if (last_name_error) {
                                $('#last_name').addClass('is-invalid')
                                $('.last-name-error').show().text(errors[i])
                                break
                            } else {
                                $('#last_name').removeClass('is-invalid')
                                $('.last-name-error').hide()
                            }

                            if (sex_error) {
                                $('#sex').addClass('is-invalid')
                                $('.sex-error').show().text(errors[i])
                                break
                            } else {
                                $('#sex').removeClass('is-invalid')
                                $('.sex-error').hide()
                            }

                            if (email_error) {
                                $('#email_address').addClass('is-invalid')
                                $('.email-address-error').show().text(errors[i])
                                break
                            } else {
                                $('#email_address').removeClass('is-invalid')
                                $('.email-address-error').hide()
                            }

                            if (username_error) {
                                $('#username').addClass('is-invalid')
                                $('.username-error').show().text(errors[i])
                                break
                            } else {
                                $('#username').removeClass('is-invalid')
                                $('.username-error').hide()
                            }

                            if (password_error) {
                                $('#password').addClass('is-invalid')
                                $('.password-error').show().text(errors[i])
                                break
                            } else {
                                $('#password').removeClass('is-invalid')
                                $('.password-error').hide()
                            }

                            if (confirm_password_error) {
                                $('#confirm_password').addClass('is-invalid')
                                $('.confirm-password-error').show().text(errors[i])
                                break
                            } else {
                                $('#confirm_password').removeClass('is-invalid')
                                $('.confirm-password-error').hide()
                            }

                            if (contact_error) {
                                $('#contact_no').addClass('is-invalid')
                                $('.contact-no-error').show().text(errors[i])
                                break
                            } else {
                                $('#contact_no').removeClass('is-invalid')
                                $('.contact-no-error').hide()
                            }

                            if (address_error) {
                                $('#address').addClass('is-invalid')
                                $('.address-error').show().text(errors[i])
                                break
                            } else {
                                $('#address').removeClass('is-invalid')
                                $('.address-error').hide()
                            }

                            if (captcha_error) {
                                $('#captcha').addClass('is-invalid')
                                $('.captcha-error').show().text(errors[i])
                                break
                            } else {
                                $('#captcha').removeClass('is-invalid')
                                $('.captcha-error').hide()
                            }

                        }
                    } else {
                        var html = '<p class="p-2 bg-success text-white">'+response.data.message+'</p>'
                        $('.flash-container').html(html)
                        setTimeout(function() {
                            window.location.href = "{{url('/customer/login')}}" 
                        }, 5000)
                    }
                })

            } else {
                $('.agreement-error').show()
                e.preventDefault();
            }
        }
    </script>

    <script src="{{ url('assets/js/admin/particles.js') }}"></script>
    <script src="{{ url('assets/js/admin/particles-config.js') }}"></script>
</body>
</html>