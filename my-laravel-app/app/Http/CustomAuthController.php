public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $email = $request->input('email');
    $password = $request->input('password');

    // 🔵 البحث عن المستخدم في جدول `Instructor`
    $user = Instructor::where('email', $email)->first();

    if ($user) {
        if (Hash::check($password, $user->password)) {
            // ✅ تسجيل الدخول كمستخدم في `auth:instructor`
            Auth::guard('instructor')->login($user);

            // ✅ توجيه بناءً على `RoleID`
            if ($user->RoleID == 1) {
                return redirect('/admin-dashboard'); // إذا كان Admin
            } else {
                return redirect('/instructor-dashboard'); // إذا كان مدرب عادي
            }
        } else {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }
    }

    return back()->withErrors(['email' => 'Invalid credentials or user not found.']);
}

