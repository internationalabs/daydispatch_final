{{-- <!DOCTYPE html>
<html>
<head>
    <title>Pickup Online BOL Submission</title>
</head>
<body>
    <h1>Pickup Online BOL Details</h1>
    <p><strong>Order ID:</strong> {{ $data['order_id'] }}</p>
    <p><strong>Key:</strong> {{ $data['key'] }}</p>
    <p><strong>Odometer:</strong> {{ $data['no_odometer'] }}</p>
    <p><strong>Inspection Note:</strong> {{ $data['no_inspection_note'] }}</p>
    <p><strong>Remote:</strong> {{ $data['remote'] }}</p>
    <p><strong>Headrests:</strong> {{ $data['headrests'] }}</p>
    <p><strong>Drivable:</strong> {{ $data['drivable'] }}</p>
    <p><strong>Windscreen:</strong> {{ $data['windscreen'] }}</p>
    <p><strong>Glass All Intact:</strong> {{ $data['glass_all_intact'] }}</p>
    <p><strong>Title:</strong> {{ $data['title'] }}</p>
    <p><strong>Cargo Cover:</strong> {{ $data['cargo_cover'] }}</p>
    <p><strong>Spare Tire:</strong> {{ $data['spare_tire'] }}</p>
    <p><strong>Radio:</strong> {{ $data['radio'] }}</p>
    <p><strong>Manual:</strong> {{ $data['manual'] }}</p>
    <p><strong>Navigation Disk:</strong> {{ $data['navigation_disk'] }}</p>
    <p><strong>Plugin Charger Cable:</strong> {{ $data['plugin_charger_cable'] }}</p>
    <p><strong>Headphone:</strong> {{ $data['headphone'] }}</p>

    <h2>Dispatch Online Bol Details</h2>
    <p><strong>Key:</strong> {{ $data['deliver_key'] }}</p>
    <p><strong>Odometer:</strong> {{ $data['deliver_no_odometer'] }}</p>
    <p><strong>Inspection Note:</strong> {{ $data['deliver_no_inspection_note'] }}</p>
    <p><strong>Remote:</strong> {{ $data['deliver_remote'] }}</p>
    <p><strong>Headrests:</strong> {{ $data['deliver_headrests'] }}</p>
    <p><strong>Drivable:</strong> {{ $data['deliver_drivable'] }}</p>
    <p><strong>Windscreen:</strong> {{ $data['deliver_windscreen'] }}</p>
    <p><strong>Glass All Intact:</strong> {{ $data['deliver_glass_all_intact'] }}</p>
    <p><strong>Title:</strong> {{ $data['deliver_title'] }}</p>
    <p><strong>Cargo Cover:</strong> {{ $data['deliver_cargo_cover'] }}</p>
    <p><strong>Spare Tire:</strong> {{ $data['deliver_spare_tire'] }}</p>
    <p><strong>Radio:</strong> {{ $data['deliver_radio'] }}</p>
    <p><strong>Manual:</strong> {{ $data['deliver_manual'] }}</p>
    <p><strong>Navigation Disk:</strong> {{ $data['deliver_navigation_disk'] }}</p>
    <p><strong>Plugin Charger Cable:</strong> {{ $data['deliver_plugin_charger_cable'] }}</p>
    <p><strong>Headphone:</strong> {{ $data['deliver_headphone'] }}</p>

    <h2>Attached Images</h2>
    @foreach($data['images'] as $image)
        <p><img src="{{ asset($image) }}" alt="Image" style="width: 100px; height: 100px;"></p>
    @endforeach
</body>
</html>
 --}}

 <!DOCTYPE html>
<html>
<head>
    <title>DayDispatch | Order ID => {{ $data['order_id'] }}</title>
</head>
<body>

<table data-module="header-button0"
       data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2020/03/13/HQ3kphtSsgIn8Olvz9buGo5R/order_confirmation/thumbnails/header-button.png"
       width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
    <tbody>
    <tr>
        <td class="o_bg-light o_px-xs o_pt-lg o_xs-pt-xs" align="center" data-bgcolor="Bg Light"
            style="background-color: #dbe5ea;padding-left: 8px;padding-right: 8px;padding-top: 32px;">
            
            <div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div>
            <table class="o_block ui-resizable" width="100%" cellspacing="0" cellpadding="0" border="0"
                   role="presentation" style="max-width: 632px;margin: 0 auto;">
                <tbody>
                <tr>
                    <td class="o_re o_bg-dark o_px o_pb-md o_br-t" align="center" data-bgcolor="Bg Dark"
                        style="font-size: 0;vertical-align: top;background-color: #242b3d;border-radius: 4px 4px 0px 0px;padding-left: 16px;padding-right: 16px;padding-bottom: 24px;">
                        
                        <div class="o_col o_col-2"
                             style="display: inline-block;vertical-align: top;width: 100%;max-width: 200px;">
                            <div style="font-size: 24px; line-height: 24px; height: 24px;">&nbsp;</div>
                            <div class="o_px-xs o_sans o_text o_left o_xs-center" data-size="Text Default" data-min="12"
                                 data-max="20"
                                 style="font-family: Helvetica, Arial, sans-serif;margin-top: 0px;margin-bottom: 0px;font-size: 16px;line-height: 24px;text-align: left;padding-left: 8px;padding-right: 8px;">
                                <p style="margin-top: 0px;margin-bottom: 0px;"><a class="o_text-white"
                                                                                  href="{{ route('Frontend.index') }}"
                                                                                  target="_blank"
                                                                                  data-color="White"
                                                                                  style="text-decoration: none;outline: none;color: #ffffff;"><img
                                            src="{{ asset('frontend/img/logo/logo.png') }}"
                                            width="136" height="36" alt="Day Dispatch"
                                            style="max-width: 136px;-ms-interpolation-mode: bicubic;vertical-align: middle;border: 0;line-height: 100%;height: auto;outline: none;text-decoration: none;"
                                            data-crop="false"></a></p>
                            </div>
                        </div>
                        
                        <div class="o_col o_col-4"
                             style="display: inline-block;vertical-align: top;width: 100%;max-width: 400px;">
                            <div style="font-size: 24px; line-height: 24px; height: 24px;">&nbsp;</div>
                            <div class="o_px-xs" style="padding-left: 8px;padding-right: 8px;">
                                <table class="o_right o_xs-center" cellspacing="0" cellpadding="0" border="0"
                                       role="presentation" style="text-align: right;margin-left: auto;margin-right: 0;">
                                    <tbody>
                                    <tr>
                                        <td class="o_btn-xs o_bg-primary o_br o_heading o_text-xs" align="center"
                                            data-bgcolor="Bg Primary" data-size="Text XS" data-min="10" data-max="18"
                                            style="font-family: Helvetica, Arial, sans-serif;font-weight: bold;margin-top: 0px;margin-bottom: 0px;font-size: 14px;line-height: 21px;mso-padding-alt: 7px 16px;background-color: #126de5;border-radius: 4px;">
                                            <a class="o_text-white" href="{{ route('Auth.Forms') }}" data-color="White"
                                               style="text-decoration: none;outline: none;color: #ffffff;display: block;padding: 7px 16px;mso-text-raise: 3px;">Get
                                                the App</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>

<table data-module="hero-icon-outline0"
       data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2020/03/13/HQ3kphtSsgIn8Olvz9buGo5R/order_confirmation/thumbnails/hero-icon-outline.png"
       width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" class="selected-table">
    <tbody>
    <tr>
        <td class="o_bg-light o_px-xs" align="center" data-bgcolor="Bg Light"
            style="background-color: #dbe5ea;padding-left: 8px;padding-right: 8px;">
            
            <div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div>
            <table class="o_block ui-resizable" width="100%" cellspacing="0" cellpadding="0" border="0"
                   role="presentation" style="max-width: 632px;margin: 0 auto;">
                <tbody>
                <tr>
                    <td class="o_bg-ultra_light o_px-md o_py-xl o_xs-py-md o_sans o_text-md o_text-light" align="center"
                        data-bgcolor="Bg Ultra Light" data-color="Light" data-size="Text MD" data-min="15" data-max="23"
                        style="font-family: Helvetica, Arial, sans-serif;margin-top: 0px;margin-bottom: 0px;font-size: 19px;line-height: 28px;background-color: #ebf5fa;color: #82899a;padding-left: 24px;padding-right: 24px;padding-top: 64px;padding-bottom: 64px;">
                        <table cellspacing="0" cellpadding="0" border="0" role="presentation">
                            <tbody>
                            <tr>
                                <td class="o_sans o_text o_text-white o_bg-primary o_px o_py o_br-max selected-element"
                                    align="center" data-bgcolor="Bg Primary" data-color="White" data-size="Text Default"
                                    data-min="12" data-max="20"
                                    style="font-family: Helvetica, Arial, sans-serif;margin-top: 0px;margin-bottom: 0px;font-size: 16px;line-height: 24px;background-color: #126de5;color: #ffffff;border-radius: 96px;padding-left: 16px;padding-right: 16px;padding-top: 16px;padding-bottom: 16px;"
                                    data-gramm="false" wt-ignore-input="true"
                                    data-quillbot-element="z-PR9ChDxSHHUwTtnOPOd" contenteditable="true">
                                    <img
                                        src="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2020/03/13/HQ3kphtSsgIn8Olvz9buGo5R/order_confirmation/images/check-48-white.png"
                                        width="48" height="48" alt=""
                                        style="max-width: 48px;-ms-interpolation-mode: bicubic;vertical-align: middle;border: 0;line-height: 100%;height: auto;outline: none;text-decoration: none;"
                                        data-crop="false">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 24px; line-height: 24px; height: 24px;">&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                        <h2 class="o_heading o_text-dark o_mb-xxs" data-color="Dark" data-size="Heading 2" data-min="20"
                            data-max="40"
                            style="font-family: Helvetica, Arial, sans-serif;font-weight: bold;margin-top: 0px;margin-bottom: 4px;color: #242b3d;font-size: 30px;line-height: 39px;">
                            Online BOL Submission Details</h2>
                        <p style="margin-top: 0px;margin-bottom: 0px;">Your Order ID "{{ $data['order_id'] }}"</p>
                    </td>
                </tr>
                </tbody>
            </table>
            <!--[if mso]></td></tr></table><![endif]-->
        </td>
    </tr>
    </tbody>
</table>

<table data-module="spacer0"
       data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2020/03/13/HQ3kphtSsgIn8Olvz9buGo5R/order_confirmation/thumbnails/spacer.png"
       width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
    <tbody>
    <tr>
        <td class="o_bg-light o_px-xs" align="center" data-bgcolor="Bg Light"
            style="background-color: #dbe5ea;padding-left: 8px;padding-right: 8px;">
            <!--[if mso]>
            <table width="632" cellspacing="0" cellpadding="0" border="0" role="presentation">
                <tbody>
                <tr>
                    <td><![endif]-->
            <div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div>
            <table class="o_block ui-resizable" width="100%" cellspacing="0" cellpadding="0" border="0"
                   role="presentation" style="max-width: 632px;margin: 0 auto;">
                <tbody>
                <tr>
                    <td class="o_bg-white"
                        style="font-size: 24px;line-height: 24px;height: 24px;background-color: #ffffff;"
                        data-bgcolor="Bg White">&nbsp;
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>

<table data-module="order-intro0"
       data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2020/03/13/HQ3kphtSsgIn8Olvz9buGo5R/order_confirmation/thumbnails/order-intro.png"
       width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
    <tbody>
    <tr>
        <td class="o_bg-light o_px-xs" align="center" data-bgcolor="Bg Light"
            style="background-color: #dbe5ea;padding-left: 8px;padding-right: 8px;">
            
            <div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div>
            <table class="o_block ui-resizable" width="100%" cellspacing="0" cellpadding="0" border="0"
                   role="presentation" style="max-width: 632px;margin: 0 auto;">
                <tbody>
                <tr>
                    <td class="o_bg-white o_px-md o_py o_sans o_text o_text-secondary" align="center"
                        data-bgcolor="Bg White" data-color="Secondary" data-size="Text Default" data-min="12"
                        data-max="20"
                        style="font-family: Helvetica, Arial, sans-serif;margin-top: 0px;margin-bottom: 0px;font-size: 16px;line-height: 24px;background-color: #ffffff;color: #424651;padding-left: 24px;padding-right: 24px;padding-top: 16px;padding-bottom: 16px;">
                        <h4 class="o_heading o_text-dark o_mb-xs" data-color="Dark" data-size="Heading 4" data-min="10"
                            data-max="26"
                            style="font-family: Helvetica, Arial, sans-serif;font-weight: bold;margin-top: 0px;margin-bottom: 8px;color: #242b3d;font-size: 18px;line-height: 23px;">
                            From Day Dispatch</h4>
                        
                        <table align="center" cellspacing="0" cellpadding="0" border="0" role="presentation">
                            <tbody>
                            <tr>
                                <td width="300" class="o_btn o_bg-success o_br o_heading o_text" align="center"
                                    data-bgcolor="Bg Success" data-size="Text Default" data-min="12" data-max="20"
                                    style="font-family: Helvetica, Arial, sans-serif;font-weight: bold;margin-top: 0px;margin-bottom: 0px;font-size: 16px;line-height: 24px;mso-padding-alt: 12px 24px;background-color: #0ec06e;border-radius: 4px;">
                                    <a class="o_text-white" href="{{ route('Final.Bol.Listing', $data['order_id']) }}" target="_blank"
                                       data-color="White"
                                       style="text-decoration: none;outline: none;color: #ffffff;display: block;padding: 12px 24px;mso-text-raise: 3px;">Track Your Online Bol</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div style="font-size: 28px; line-height: 28px; height: 20px;">&nbsp;</div>
                        <!-- <h4 class="o_heading o_text-dark o_mb-xxs selected-element" data-color="Dark"
                            data-size="Heading 4" data-min="10" data-max="26"
                            style="font-family: Helvetica, Arial, sans-serif;font-weight: bold;margin-top: 0px;margin-bottom: 4px;color: #242b3d;font-size: 18px;line-height: 23px;"
                            contenteditable="true" data-gramm="false" wt-ignore-input="true"
                            data-quillbot-element="hTUW1QMrmqoOny8XO5GXh">Listed Price $</h4> -->
                        <!-- <p class="o_text-xs o_text-light o_mb-md" data-color="Light" data-size="Text XS" data-min="10"
                           data-max="18"
                           style="font-size: 14px;line-height: 21px;color: #82899a;margin-top: 0px;margin-bottom: 0px;">
                            Payment Method: </p> -->
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>



<table data-module="footer-3cols0"
       data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2020/03/13/HQ3kphtSsgIn8Olvz9buGo5R/order_confirmation/thumbnails/footer-3cols.png"
       width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
    <tbody>
    <tr>
        <td class="o_bg-light o_px-xs o_pb-lg o_xs-pb-xs" align="center" data-bgcolor="Bg Light"
            style="background-color: #dbe5ea;padding-left: 8px;padding-right: 8px;padding-bottom: 32px;">
            
            <div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div>
            <table class="o_block-lg ui-resizable" width="100%" cellspacing="0" cellpadding="0" border="0"
                   role="presentation" style="max-width: 632px;margin: 0 auto;">
                <tbody>
                <tr>
                    <td class="o_bg-dark o_px-md o_py-lg o_br-b" align="center" data-bgcolor="Bg Dark"
                        style="background-color: #242b3d;border-radius: 0px 0px 4px 4px;padding-left: 24px;padding-right: 24px;padding-top: 32px;padding-bottom: 32px;">
                        
                        <div class="o_col-6s o_sans o_text-xs o_text-dark_light" data-color="Dark Light"
                             data-size="Text XS" data-min="10" data-max="18"
                             style="font-family: Helvetica, Arial, sans-serif;margin-top: 0px;margin-bottom: 0px;font-size: 14px;line-height: 21px;max-width: 584px;color: #a0a3ab;">
                            <p class="o_mb" style="margin-top: 0px;margin-bottom: 16px;"><a class="o_text-dark_light"
                                                                                            href="{{ route('Frontend.index') }}"
                                                                                            target="_blank"
                                                                                            data-color="Dark Light"
                                                                                            style="text-decoration: none;outline: none;color: #a0a3ab;"><img
                                        src="{{ asset('frontend/img/favicon.png') }}"
                                        width="36" height="36" alt="Day Dispatch"
                                        style="max-width: 36px;-ms-interpolation-mode: bicubic;vertical-align: middle;border: 0;line-height: 100%;height: auto;outline: none;text-decoration: none;"
                                        data-crop="false"></a></p>
                            <p class="o_mb" style="margin-top: 0px;margin-bottom: 16px;">
                                If you have any questions, just reply to this support@daydispatch.com<br>
                                we're always happy to help out.
                            </p>
                            <p style="margin-top: 0px;margin-bottom: 0px;">Day Dispatch Team</p>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>