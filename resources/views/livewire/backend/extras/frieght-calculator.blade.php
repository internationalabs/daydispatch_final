<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>Dry Van</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Freight Class Calculator</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->

<div class="card user-settings-box">
    <form class="was-validated calculator">
        @csrf
        <div class="row " id="firstrow">
            <div class="col-lg-2 col-md-6">
                <div class="form-group">
                    <label>Select Unit</label>
                    <select class="custom-select Unit" name="Location" required>
                        <option value="0">Inches</option>
                        <option value="1">Feet</option>
                    </select>
                    <div class="invalid-feedback">Select Unit</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="form-group">
                    <label>Length *</label>
                    <input type="number" class="form-control Length"
                           placeholder="Enter Length" min="0"
                           name="Equip_Length[]" value="" required>
                    <div class="invalid-feedback">
                        Entered Length.
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="form-group">
                    <label>Width *</label>
                    <input type="number" class="form-control Width"
                           placeholder="Enter Width" min="0"
                           name="Equip_Width[]" value="" required>
                    <div class="invalid-feedback">
                        Entered Width.
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="form-group">
                    <label>Height *</label>
                    <input type="number" class="form-control Height"
                           placeholder="Enter Height" min="0"
                           name="Equip_Height[]" value="" required>
                    <div class="invalid-feedback">
                        Entered Height.
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="form-group">
                    <label>Weight *</label>
                    <input type="number" class="form-control Weight"
                           placeholder="Enter Weight" min="0"
                           name="Equip_Weight[]" value="" required>
                    <div class="invalid-feedback">
                        Entered Weight.
                    </div>
                </div>
            </div>
        </div>

        <div class="btn-box text-center">
            <button type="submit" class="submit-btn"><i class='bx bx-calculator'></i>
                Calculate
            </button>
        </div>
        <div class="card-header answer">
            <h3>Freight Class => <span id="FreightClass"></span></h3>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('.answer').hide();
        $('form.calculator').submit(function (e) {
            e.preventDefault();
            const Unit = $('select.Unit').val();
            const Length = $('input.Length').val();
            const Width = $('input.Width').val();
            const Height = $('input.Height').val();
            const Weight = $('input.Weight').val();

            let FreightClass = 0;

            if (Unit !== '0') {
                let LWH = Length * Width * Height;
                FreightClass = Weight / LWH;
            } else {
                let LWH = Length * Width * Height;
                let LWH_Inch = LWH / 1728;
                FreightClass = Weight / LWH_Inch;
            }
            console.log(calculateFreightClass(FreightClass));
            // $(this).hide();
            $('#FreightClass').html(calculateFreightClass(FreightClass));
            $('.answer').show();
        });

        //    Freight Class Check Function
        function calculateFreightClass(value){
            if (value < 1) {
                return 500;
            } else if (value >= 1 && value < 2) {
                return 400;
            } else if (value >= 2 && value < 3) {
                return 300;
            } else if (value >= 3 && value < 4) {
                return 250;
            } else if (value >= 4 && value < 5) {
                return 200;
            } else if (value >= 5 && value < 6) {
                return 175;
            } else if (value >= 6 && value < 7) {
                return 150;
            } else if (value >= 7 && value < 8) {
                return 125;
            } else if (value >= 8 && value < 9) {
                return 110;
            } else if (value >= 9 && value < 10.5) {
                return 100;
            } else if (value >= 10.5 && value < 12) {
                return 92.5;
            } else if (value >= 12 && value < 13.5) {
                return 85;
            } else if (value >= 13.5 && value < 15) {
                return 77.5;
            } else if (value >= 15 && value < 22.5) {
                return 70;
            } else if (value >= 22.5 && value < 30) {
                return 65;
            } else if (value >= 30 && value < 35) {
                return 60;
            } else if (value >= 35 && value < 50) {
                return 55;
            } else {
                return 50;
            }
        }
    });
</script>
