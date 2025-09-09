# MyWebApp

# Sprint 3 : 9/9/2025
## Module 2 : Building Web Applications with Laravel
### Nội dung bao gồm Routing, Controllers, Views, Database Migrations, Eloquent ORM, Middleware, Authentication, và Blade Templating System
### User Story 5 : Routing in Laravel 
#### Nội dung chính:

@ Route : Định nghĩa đường dẫn URL và liên kết nó với hành động xử lý (callback hoặc controller method).

Cho phép xử lý yêu cầu theo GET, POST, và các phương thức HTTP khác → tùy ý trong thiết kế ứng dụng.

Giúp xây dựng các ứng dụng theo mô hình MVC một cách rõ ràng và có cấu trúc.
#### Trong khóa học, ta sẽ học cách:
- Định nghĩa route đơn giản (closure hoặc view).

- Truyền tham số động vào route.

- Gắn route với phương thức controller.

- Tạo route có tên để thuận tiện khi generate URL.
### User Story 6 : Controllers in Laravel
#### Nội dung chính :
- Giải thích Controller là gì trong Laravel và vị trí của nó trong luồng xử lý request.

- Cách tổ chức Controller để xử lý nhiều hành động (multi-action) hoặc hướng RESTful (resource controller) — giúp ứng dụng rõ ràng và dễ bảo trì.

- Controller xử lý request đầu vào, thực thi logic nghiệp vụ (gọi model hoặc service), rồi trả về view hoặc dữ liệu khác (như JSON hoặc redirect).

- Thói quen tốt: giữ controller nhẹ (thin controller), tách logic phức tạp ra service hoặc lớp chuyên biệt để dễ test và bảo trì.

- Sự tích hợp với middleware, authorization, và form validation — Controllers thường sử dụng các thành phần này để xử lý request một cách an toàn và có kiểm soát.

### User Story 7 : Views in Laravel
#### Nội dung chính
- View là nơi trình bày dữ liệu với người dùng — thường là file Blade (template engine của Laravel).

- Controller gọi view, truyền dữ liệu từ backend (Controller) tới giao diện client.

- Vai trò quan trọng của Blade trong việc tạo giao diện dễ tái sử dụng và có cấu trúc — như kế thừa layout, sử dụng directive, và in biến an toàn.
