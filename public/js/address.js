$(document).ready(function () {
    // Lấy oldAddress từ biến global được khai báo trong Blade
    const oldAddress = window.oldAddress;
    console.log("Old Address:", oldAddress);

    // Lấy các phần tử cần dùng
    const $provinceSelect = $("#province-select");
    const $districtSelect = $("#district-select");
    const $wardSelect = $("#ward-select");
    const $addressJsonField = $("#address-json");

    // Cờ để áp dụng oldAddress chỉ cho lần load đầu tiên
    let initialLoad = true;

    // Nếu có oldAddress, cập nhật luôn giá trị vào trường ẩn
    if (oldAddress) {
        $addressJsonField.val(JSON.stringify(oldAddress));
    }

    // Hàm cập nhật JSON của địa chỉ vào trường ẩn
    function updateAddressJson() {
        const addressData = {
            province: {
                code: $provinceSelect.val(),
                name: $provinceSelect.find(':selected').data('name') || ""
            },
            district: {
                code: $districtSelect.val(),
                name: $districtSelect.find(':selected').data('name') || ""
            },
            ward: {
                code: $wardSelect.val(),
                name: $wardSelect.find(':selected').data('name') || ""
            }
        };
        $addressJsonField.val(JSON.stringify(addressData));
        console.log("Updated Address JSON:", addressData);
    }

    // Load danh sách Tỉnh/Thành phố
    $.ajax({
        url: "https://provinces.open-api.vn/api/p/",
        type: "GET",
        success: function (provinces) {
            let provinceOptions = '<option value="">-- Chọn Tỉnh/Thành phố --</option>';
            provinces.forEach(function (province) {
                provinceOptions += `<option value="${province.code}" data-name="${province.name}">${province.name}</option>`;
            });
            $provinceSelect.html(provinceOptions);

            // Nếu có dữ liệu cũ và là lần load đầu, chọn luôn Tỉnh/Thành phố
            if (oldAddress && oldAddress.province && oldAddress.province.code && initialLoad) {
                $provinceSelect.val(oldAddress.province.code).trigger("change");
            }
        },
        error: function (err) {
            console.error("Error loading provinces", err);
        }
    });

    // Khi chọn Tỉnh/Thành phố: Load Quận/Huyện tương ứng
    $provinceSelect.on("change", function () {
        let provinceCode = $(this).val();

        // Reset lại Quận/Huyện và Phường/Xã
        $districtSelect.html('<option value="">-- Chọn Quận/Huyện --</option>').prop("disabled", true);
        $wardSelect.html('<option value="">-- Chọn Phường/Xã --</option>').prop("disabled", true);
        updateAddressJson();

        if (provinceCode) {
            $.ajax({
                url: `https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`,
                type: "GET",
                success: function (data) {
                    let districtOptions = '<option value="">-- Chọn Quận/Huyện --</option>';
                    data.districts.forEach(function (district) {
                        districtOptions += `<option value="${district.code}" data-name="${district.name}">${district.name}</option>`;
                    });
                    $districtSelect.html(districtOptions).prop("disabled", false);

                    // Nếu có dữ liệu cũ, chọn luôn Quận/Huyện và trigger change để load Phường/Xã
                    if (oldAddress && oldAddress.district && oldAddress.district.code && initialLoad) {
                        $districtSelect.val(oldAddress.district.code).trigger("change");
                    }
                },
                error: function (err) {
                    console.error("Error loading districts", err);
                }
            });
        }
    });

    // Khi chọn Quận/Huyện: Load Phường/Xã tương ứng
    $districtSelect.on("change", function () {
        let districtCode = $(this).val();

        // Reset lại Phường/Xã
        $wardSelect.html('<option value="">-- Chọn Phường/Xã --</option>').prop("disabled", true);
        updateAddressJson();

        if (districtCode) {
            $.ajax({
                url: `https://provinces.open-api.vn/api/d/${districtCode}?depth=2`,
                type: "GET",
                success: function (data) {
                    let wardOptions = '<option value="">-- Chọn Phường/Xã --</option>';
                    data.wards.forEach(function (ward) {
                        wardOptions += `<option value="${ward.code}" data-name="${ward.name}">${ward.name}</option>`;
                    });
                    $wardSelect.html(wardOptions).prop("disabled", false);

                    // Nếu có dữ liệu cũ, chọn luôn Phường/Xã
                    if (oldAddress && oldAddress.ward && oldAddress.ward.code && initialLoad) {
                        $wardSelect.val(oldAddress.ward.code);
                        updateAddressJson(); // cập nhật JSON sau khi chọn
                        // Tắt cờ initialLoad để sau này người dùng tự thay đổi không bị ghi đè
                        initialLoad = false;
                    }
                },
                error: function (err) {
                    console.error("Error loading wards", err);
                }
            });
        }
    });

    // Khi chọn Phường/Xã, cập nhật JSON
    $wardSelect.on("change", function () {
        updateAddressJson();
    });
});
