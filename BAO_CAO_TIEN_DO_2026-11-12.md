# Báo cáo rà soát tiến độ đồ án Travivu

Ngày rà soát: 12/11/2026. Dùng chuẩn bị báo cáo tiến độ ngày 13/11/2026.

## 1. Kết luận hiện tại

Dự án đã xây dựng được phần khách hàng với dữ liệu tour thật: tài khoản, kích hoạt email, đăng nhập Google, hồ sơ cá nhân, danh sách và chi tiết tour, lọc/sắp xếp, cùng xử lý tạo đơn đặt tour ở phía máy chủ. Đây là nền tảng phù hợp để phát triển đồ án website đặt tour.

Tuy nhiên, chưa thể xem là hệ thống đặt tour hoàn chỉnh. Luồng hiện dừng ở tạo đơn chờ xác nhận; chưa có lịch sử đặt tour, quản trị đơn, thanh toán và quản trị nội dung. Ngoài ra, form đặt tour hiện đang thiếu ba trường bắt buộc do bị comment, nên cần sửa trước khi demo tạo đơn mới.

Không quy đổi tiến độ thành phần trăm vì chưa có danh sách yêu cầu và tiêu chí chấm đã chốt. Cần đối chiếu thêm đề cương với giảng viên để xác định tính năng bắt buộc.

## 2. Phạm vi và độ chắc chắn của việc kiểm tra

- Đã đọc routes, controllers, models, Blade, JavaScript liên quan, migration và cấu trúc database đang sử dụng.
- Đã kiểm tra số lượng dữ liệu và một đơn thử, không thay đổi dữ liệu.
- Đã thử dựng HTML từ một số controller/view và thực thi một số truy vấn lọc. Đây không phải kiểm thử toàn bộ qua trình duyệt.
- Kiểm tra cú pháp 26 file PHP trong app/routes và JavaScript login.js: không phát hiện lỗi cú pháp.
- Chưa thực hiện lại gửi email thật, đăng nhập Google trên trình duyệt, thanh toán hoặc gửi đơn mới trong lượt rà soát này.
- Không sửa mã ứng dụng hay database. Tệp này chỉ là báo cáo.

## 3. Nền tảng và cách tổ chức

- Laravel 12, PHP theo yêu cầu composer từ 8.2; Blade, Bootstrap, jQuery; Google Socialite.
- Route tiếp nhận yêu cầu; controller kiểm tra dữ liệu và điều phối; model/truy vấn đọc ghi database; view hiển thị.
- Tài khoản đang thống nhất dùng App\Models\User kết nối tbl_user, khóa chính userid.
- Booking dùng App\Models\client\Booking kết nối tbl_booking, khóa chính bookingid.
- Cách tổ chức MVC đã hình thành, nhưng còn model cũ, các hàm controller rỗng, cách đặt tên chưa nhất quán và một số truy vấn lặp.

## 4. Những phần đã có

| Nhóm | Xử lý đã viết | Giới hạn hiện tại |
|---|---|---|
| Đăng ký | Kiểm tra tên/email trùng, xác nhận mật khẩu, băm mật khẩu, tạo tài khoản chưa kích hoạt | Cần chuẩn hóa tên/email ở máy chủ và bổ sung UNIQUE trong database |
| Kích hoạt email | Token ngẫu nhiên, lưu bản băm; liên kết có chữ ký và hạn 60 phút; kích hoạt một lần | Không còn gửi lại theo yêu cầu trước đó; chưa có cách tự phục hồi khi hết hạn/gửi mail lỗi |
| Đăng nhập/đăng xuất | Tên đăng nhập hoặc email; kiểm tra mật khẩu, trạng thái, kích hoạt; tạo/hủy phiên đăng nhập | Ô “Nhớ tài khoản” chưa được nối vào xử lý |
| Google | Nhận email đã xác minh; tạo/tìm tài khoản; Auth::login và lưu phương thức đăng nhập | Chưa hỗ trợ liên kết Google với tài khoản mật khẩu đã có cùng email |
| Hồ sơ | Xem tài khoản, cập nhật họ tên, số điện thoại, địa chỉ | Chưa có chức năng thay ảnh đại diện thực tế được xác nhận trong luồng này |
| Đổi mật khẩu | Kiểm tra mật khẩu hiện tại, độ dài, khác mật khẩu cũ và xác nhận; thông báo tiếng Việt | Chặn phiên đăng nhập Google đúng yêu cầu hiện tại |
| Trang chủ | Đọc tour, ảnh, thời lượng và giá từ database; dẫn sang chi tiết | Một số khu vực khác vẫn là dữ liệu mẫu |
| Danh sách tour | Lọc miền, số sao, thời lượng, khoảng giá; sắp xếp; phân trang và giữ lựa chọn | Mới/cũ dựa tourid; thời lượng là chuỗi; chưa phản ánh số chỗ còn lại |
| Chi tiết tour | Hiển thị dữ liệu tour, ảnh, lịch trình và khu vực đặt tour | Chưa xử lý tốt tour không tồn tại hoặc thiếu ảnh |
| Tạo đơn | Kiểm tra dữ liệu, trạng thái tour, ngày khởi hành, chỗ trống; tự tính tiền và lưu pending | Form hiện bị thiếu các ô liên hệ bắt buộc; vòng đời đơn chưa hoàn chỉnh |
| Giao diện | Đã tùy chỉnh hồ sơ, thông báo, nút xem mật khẩu, các thẻ tour, khoảng cách và hiệu ứng | Còn nội dung mẫu, liên kết chưa hoạt động và cần thử lại trên điện thoại |

Lưu ý: có code xử lý không đồng nghĩa đã kiểm thử đầy đủ mọi tình huống trên trình duyệt.

## 5. Database đang có gì?

| Bảng | Số bản ghi tại thời điểm kiểm tra | Vai trò |
|---|---:|---|
| tbl_user | 3 | Tài khoản đang sử dụng |
| tbl_tour | 3 | Tour |
| tbl_images | 15 | Ảnh tour |
| tbl_timeline | 6 | Lịch trình |
| tbl_booking | 1 | Đơn đặt thử |
| tbl_reviews | 0 | Chưa có dữ liệu đánh giá |
| tbl_checkout | 0 | Chưa có giao dịch thanh toán |
| tbl_admin | 0 | Chưa triển khai quản trị |
| tbl_history, tbl_invoice, tbl_promotion | 0 mỗi bảng | Chưa nối vào nghiệp vụ thực tế |
| users | 0 | Bảng mặc định; không phải bảng tài khoản hiện dùng |

Đơn số 1: tour 3, 2 người lớn × 4.100.000 + 1 trẻ em × 3.000.000 = 11.200.000 đồng, trạng thái pending. Đơn có lưu đơn giá tại thời điểm đặt. Đây là bằng chứng đã từng lưu đơn đúng; không chứng minh form hiện tại vẫn gửi được sau khi các ô liên hệ bị comment.

Trong 3 tour, tour 3 mở đặt và có ngày khởi hành 20/11/2026. Hai tour còn lại có availability = 0 và ngày khởi hành trong quá khứ. Khi demo đặt tour, cần chọn tour còn mở và chưa đến ngày khởi hành.

### Các chỉnh sửa database nên ưu tiên

1. Đồng bộ migration với database thật. Migration tbl_tour còn tourId, images, itinerary, thiếu time/domain; migration ảnh/lịch trình cũng lệch tên cột. Chưa có migration tái tạo đúng tbl_user và tbl_booking hiện tại. Bản SQL cũ cũng chưa phản ánh đủ các cột mới. Hiện chưa thể bảo đảm dựng đúng dự án trên máy mới từ repository.
2. Bổ sung ràng buộc UNIQUE cho username, email và googleid sau khi kiểm tra dữ liệu trùng. Validation ứng dụng không thay thế hoàn toàn ràng buộc database khi có yêu cầu đồng thời.
3. Dùng DECIMAL cho giá tour và số tiền thanh toán; tbl_booking đã dùng DECIMAL nhưng tbl_tour và tbl_checkout còn kiểu số thực.
4. Thêm thời điểm tạo/cập nhật phù hợp. Không gán ngày hiện tại cho dữ liệu cũ rồi coi đó là ngày tạo thật. Trước mắt có thể tiếp tục dùng tourid để biểu diễn thứ tự thêm dữ liệu.
5. Chuẩn hóa thời lượng thành số ngày/số đêm, tránh phụ thuộc chuỗi nhập như “3 Ngày 2 Đêm”.
6. Chuẩn hóa trạng thái đơn và quy tắc chuyển trạng thái. Bổ sung thời hạn giữ chỗ nếu pending giữ chỗ có giới hạn.
7. Khi làm đánh giá, bổ sung quan hệ tour của tbl_reviews và quy tắc số sao 1–5. Xem lại cột timestamp tự cập nhật vì thời gian tạo đánh giá không nên bị thay đổi khi sửa nội dung.
8. Khi làm thanh toán, quy định transactionid duy nhất khi có mã giao dịch, tách thời điểm tạo/cập nhật/thanh toán. paymentDate hiện tự đổi khi cập nhật dòng, không phù hợp để ghi cố định thời điểm thanh toán.

tbl_booking đã có khóa ngoại đến tbl_user và tbl_tour. Chưa cần tách lịch khởi hành thành bảng riêng nếu phạm vi hiện tại là một tour tương ứng một đợt khởi hành; chỉ tách khi cần bán nhiều đợt cho cùng một tour.

Không chạy migrate:fresh trên database đang có dữ liệu để giải quyết việc lệch migration. Cần sao lưu và lập thay đổi có kiểm soát.

## 6. Luồng xử lý đã hợp lý chưa?

### Tài khoản

Đăng ký → kiểm tra đầu vào → lưu mật khẩu băm, isActive = n → gửi liên kết kích hoạt → xác minh chữ ký/hạn/token → chuyển isActive = Y → cho đăng nhập.

Luồng chính hợp lý. Việc đổi mã phiên sau đăng nhập, dùng POST và CSRF khi đăng xuất, giới hạn tần suất đăng nhập/đăng ký là các điểm tốt.

Nhánh còn thiếu: gửi mail lỗi hoặc link hết hạn. Tài khoản đã tồn tại nhưng chưa kích hoạt, người dùng không thể đăng ký lại cùng email; chức năng gửi lại đã bỏ và chưa có trang quản trị hỗ trợ. Cần chốt cách hỗ trợ thay thế. Không nhất thiết đưa lại nút gửi lại nếu không muốn.

Google là luồng riêng: nhận danh tính Google đã xác minh → tìm/tạo tài khoản → kiểm tra trạng thái → đăng nhập. Việc từ chối tự liên kết email trùng là giới hạn có chủ đích, không phải lỗi cần bỏ kiểm tra.

### Tìm và xem tour

Chọn bộ lọc → GET trang Tour → controller kiểm tra tham số → model áp dụng điều kiện/sắp xếp → phân trang → Blade giữ lựa chọn và hiển thị kết quả.

Luồng này đủ phù hợp cho đồ án hiện tại, không bắt buộc chuyển AJAX. Đã kiểm tra: danh sách mặc định có 3 tour; miền Trung có 2; giá tối đa 1 triệu có 1; chọn 5 sao không có kết quả vì chưa có đánh giá.

Điểm cần làm rõ:

- Bộ lọc sao đang so sánh đúng điểm trung bình đã chọn theo yêu cầu trước đó: điểm 4,5 sẽ không thuộc lựa chọn 4 hoặc 5 sao. Đây là quy tắc cần giải thích rõ trên giao diện.
- “Mới nhất/cũ nhất” hiện là thứ tự tourid, không phải ngày khởi hành và cũng chưa phải thời gian tạo thực tế.
- Tour đóng/quá hạn vẫn được liệt kê. Có thể giữ để tham khảo, nhưng cần nhãn trạng thái và nút đặt phù hợp.
- Số 50 đang là sức chứa tổng, không phải số chỗ còn trống.
- Tìm kiếm ở banner trang chủ chưa nối vào xử lý điểm đến/ngày đi/ngày về. Không nên gộp phần này với bộ lọc Tour đã hoạt động khi báo cáo.

### Đặt tour

Luồng dự kiến: đăng nhập → chọn tour/số khách/nhập liên hệ → POST store → kiểm tra → khóa dòng tour trong giao dịch → kiểm tra chỗ → tính giá từ database → lưu đơn pending → thông báo thành công.

Phía máy chủ đã có những xử lý quan trọng:

- Lấy người đặt từ phiên đăng nhập, không lấy userid do form gửi.
- Lấy đơn giá từ database, không tin tổng tiền phía trình duyệt.
- Lưu đơn giá vào đơn để lịch sử không đổi khi giá tour thay đổi.
- Đếm chỗ của pending/confirmed, dùng transaction và khóa dòng tour để phối hợp các yêu cầu qua luồng này.
- Chặn tour đóng, đến ngày khởi hành, thiếu chỗ và giá không hợp lệ.

Điểm đứt hiện tại: form không gửi contactName/contactEmail/contactPhone vì bị comment, trong khi store bắt buộc có cả ba. Cần đưa lại ô nhập hoặc xây bước thu thập liên hệ đầy đủ trước khi gọi store. Không bỏ validation chỉ để hết báo lỗi.

Sau khi lưu pending, người dùng chưa có nơi xem đơn, quản trị chưa có nơi xác nhận/hủy, đơn chưa có thời hạn giữ chỗ và gửi lại form có thể tạo đơn trùng. Đây là phần nghiệp vụ cần hoàn thiện tiếp.

## 7. Các lỗi cụ thể, theo thứ tự ưu tiên

| Ưu tiên | Vấn đề và vị trí | Cần làm |
|---|---|---|
| Trước demo | tour-detail.blade.php dòng 448–483 comment cả 3 ô liên hệ; BookingController::store vẫn yêu cầu | Khôi phục form và thông báo từng ô; kiểm tra lại một đơn mới có chủ đích |
| Trước demo | BlogController::index chưa truyền title; thử dựng view báo Undefined variable $title | Truyền đủ dữ liệu cho layout |
| Trước demo | Tour_detailController trả view dù tourdetail = null | Trả 404 khi không tìm thấy tour |
| Trước demo | Chi tiết truy cập cứng ảnh thứ 1 đến thứ 5 | Cho phép ít ảnh, có ảnh dự phòng; tránh lỗi khi thêm tour mới |
| Trước demo | “Tour đã đặt” trong hai header trỏ đến login; checkout.blade.php trống | Sửa liên kết khi có trang tương ứng hoặc thể hiện rõ chưa hỗ trợ |
| Sớm | Form liên hệ gửi đến domain của nhà cung cấp template | Gỡ/khóa việc gửi đến địa chỉ đó, sau đó nối vào controller của dự án |
| Sớm | /signup trỏ view clients.signup không tồn tại; /infor cũ thiếu title và không có auth | Bỏ hoặc chuyển hướng route cũ sang luồng đang dùng |
| Sớm | Migration/SQL cũ không khớp database đang chạy | Chuẩn hóa cách dựng database và dữ liệu mẫu |
| Sớm | Không có UNIQUE email/username/googleid trong tbl_user | Kiểm tra trùng rồi thêm ràng buộc |
| Sau khi luồng chính ổn | DestinationController dùng clients.Destination, file thực tế destination.blade.php | Đồng nhất chữ hoa/thường để tránh lỗi khi chuyển Linux |

## 8. Chức năng chưa có hoặc chỉ có giao diện

- Lịch sử đặt tour của người đăng nhập; xem chi tiết và trạng thái đơn của chính mình.
- Hủy đơn với điều kiện rõ ràng; hết hạn giữ chỗ; chống gửi đơn trùng.
- Trang quản trị và phân quyền; quản lý tour, ảnh, lịch trình, tài khoản, đơn.
- Checkout: file view hiện rỗng; chưa có quy trình xác nhận/thanh toán.
- Tích hợp thanh toán, xác minh kết quả từ cổng thanh toán và ghi nhận giao dịch.
- Email thông báo đơn; hóa đơn; mã giảm giá; thống kê doanh thu.
- Tạo đánh giá sau khi đi tour; yêu thích tour. Có biểu tượng/bảng không đồng nghĩa đã có chức năng.
- Tìm kiếm thực tế từ banner trang chủ.
- Xử lý gửi liên hệ; nội dung blog/điểm đến có quản trị.
- Quên mật khẩu; ghi nhớ đăng nhập; liên kết tài khoản Google hiện hữu.
- Bộ kiểm thử nghiệp vụ. Các test hiện có chủ yếu là mẫu mặc định, chưa bảo vệ các luồng quan trọng.

Không phải tất cả đều bắt buộc làm ngay. Phạm vi tối thiểu nên tập trung vào tài khoản → chọn tour → tạo đơn → xem đơn → quản trị xử lý đơn; thanh toán tùy đề cương đã thống nhất.

## 9. Phần thừa và cần dọn

### Có thể dọn sau khi kiểm tra tham chiếu

- app/Models/client/user.php rỗng, trong khi hệ thống đang dùng app/Models/User.php.
- app/Models/client/login.php cũ không nằm trong luồng xác thực hiện tại; còn cách kiểm tra mật khẩu và kích hoạt khác luồng mới.
- getAllTour() trong model tour chưa được gọi trong luồng hiện tại, lặp ý tưởng lấy tour/ảnh ở Home.
- Các hàm CRUD rỗng, import không sử dụng, đoạn xử lý cũ bị comment trong controller.
- Route /signup, /infor và các view nháp không còn tương ứng với luồng chính.
- Nhãn activation-email còn trong login.js sau khi bỏ chức năng gửi lại.
- header.blade.php nạp custom-css.css hai lần.
- Dòng //pro5 trong HTML của hai header không phải cú pháp comment HTML/Blade.
- Các nhãn mẫu beach/abc/def..., con số quảng bá viết cứng và link .html/# không có chức năng.

### Chưa nên xóa chỉ vì đang trống

- tbl_checkout, tbl_invoice, tbl_promotion...: xác định có nằm trong phạm vi đồ án không trước khi giữ hoặc bỏ.
- users, password_reset_tokens và các file mặc định: xem lại factory, test, migration trước khi dọn.
- Thư viện JavaScript/CSS: phải kiểm tra nơi sử dụng; không xóa hàng loạt theo cảm giác.
- Thuộc tính email_verified_at/remember_token trong User là cấu hình mặc định chưa khớp đầy đủ database; chưa gây lỗi ở luồng hiện tại, cần thống nhất với chức năng sẽ làm.

## 10. Cải thiện code theo mức cần thiết

1. Ưu tiên lỗi luồng và dữ liệu trước việc chỉnh CSS thêm.
2. Giữ một model tài khoản chính. Đặt tên class/file nhất quán như Tour, tránh user/User dễ nhầm.
3. Giữ kiểm tra đầu vào và bảo vệ route; khi controller dài hơn có thể tách Form Request và phần nghiệp vụ đặt tour, chưa cần xây kiến trúc phức tạp ngay.
4. Trang chủ đang lấy ảnh riêng cho từng tour và tải toàn bộ tour. Nên giới hạn số tour hiển thị và lấy ảnh theo nhóm như trang danh sách.
5. Khai báo quan hệ model nếu chuyển dần sang Eloquent; không cần viết lại mọi Query Builder đang đúng chỉ để có quan hệ.
6. Bổ sung thứ tự hiển thị lịch trình và ảnh rõ ràng.
7. Viết kiểm thử các tình huống có giá trị: tài khoản chưa kích hoạt; sai xác nhận mật khẩu; đặt quá số chỗ; tour hết hạn; tự ý thay giá; xem/hủy đơn của người khác; gửi lại yêu cầu tạo đơn.
8. Kiểm tra giao diện trên điện thoại, lỗi dữ liệu trống và thông báo sau khi gửi form.

## 11. Kế hoạch làm tiếp

### Đợt 1 — Ổn định phần đang có

Sửa form liên hệ đặt tour; lỗi Blog; xử lý tour không tồn tại/thiếu ảnh; dọn liên kết dẫn sai và dữ liệu mẫu dễ thấy. Kiểm tra lại đăng nhập thường/Google, hồ sơ và một đơn đặt mới. Xuất bản sao database hiện tại để chuẩn bị demo.

### Đợt 2 — Hoàn thành vòng đời đơn

Xây “Tour đã đặt” theo userid của phiên đăng nhập; chi tiết đơn và quyền truy cập; quản trị đăng nhập/phân quyền và danh sách đơn; xác nhận/hủy; cập nhật chỗ trống; quy định hạn giữ chỗ và chống tạo trùng.

### Đợt 3 — Quản trị dữ liệu và tái dựng dự án

Quản lý tour, ảnh, lịch trình, ngày đi và sức chứa qua giao diện. Đồng bộ migration, dữ liệu mẫu, ràng buộc database; kiểm tra cài đặt trên database thử riêng.

### Đợt 4 — Thanh toán và tính năng bổ sung theo đề cương

Xây checkout rồi tích hợp phương thức thanh toán đã chọn, lưu giao dịch và xác minh kết quả phía máy chủ. Sau đó email đơn, đánh giá, tìm kiếm banner, quên mật khẩu. Mã giảm giá/thống kê nâng cao làm khi phần cốt lõi ổn định.

## 12. Nội dung có thể trình bày ngày mai

“Em đã xây dựng phần khách hàng của website du lịch bằng Laravel. Phần tài khoản gồm đăng ký, kích hoạt email, đăng nhập thường và Google, cập nhật hồ sơ và đổi mật khẩu. Dữ liệu tour được lấy từ database; người dùng xem chi tiết, lọc theo khu vực, thời lượng, số sao, giá và sắp xếp kết quả. Em đã viết xử lý tạo đơn có kiểm tra ngày khởi hành, sức chứa, tính tiền phía máy chủ và lưu đơn giá tại thời điểm đặt. Database hiện đã có một đơn thử lưu đúng tổng tiền. Em đang hoàn thiện lại form đặt tour và sẽ tiếp tục lịch sử đơn, quản trị xác nhận/hủy, rồi thanh toán. Phần migration cũng cần đồng bộ với database hiện tại để triển khai trên máy khác.”

Chỉ nói “đã kiểm thử tạo đơn từ form hiện tại” sau khi đã sửa lỗi thiếu liên hệ và thử lại thành công. Chưa trình bày thanh toán, quản trị, đánh giá hoặc tìm kiếm banner là tính năng hoàn thành.

### Gợi ý thứ tự demo

1. Trang chủ → danh sách Tour → lọc miền Trung, lọc giá, sắp xếp.
2. Chi tiết tour 3 → ảnh, lịch trình, giá và ngày khởi hành.
3. Đăng nhập → thông tin cá nhân → cập nhật hồ sơ; giải thích đổi mật khẩu chỉ dành cho phiên đăng nhập thường.
4. Nếu đã sửa và kiểm tra form: đặt tour → xem thông báo → đối chiếu bản ghi tbl_booking.
5. Nếu chưa sửa form: chỉ trình bày cấu trúc xử lý và đơn thử đã lưu, nói rõ phần giao diện đang hoàn thiện.
6. Kết thúc bằng kế hoạch hoàn thành quản trị đơn, lịch sử đặt tour và thanh toán.
