@extends('layouts.dashboard')

@section('title', 'Settings')
@php $pageTitle = 'Settings'; @endphp

@section('content')
<div class="dash-page" x-data="{ tab: '{{ request('tab', 'profile') }}' }">

    {{-- ══ PAGE HEADER ══════════════════════════════════════════════ --}}
    <div class="dash-welcome">
        <div class="dash-welcome__text">
            <h2 class="dash-welcome__heading">Settings</h2>
            <p class="dash-welcome__sub">Manage your account, preferences, and notifications.</p>
        </div>
    </div>

    <div class="dash-settings-layout">

        {{-- ══ SETTINGS SIDEBAR NAV ══════════════════════════════════ --}}
        <nav class="dash-settings-nav" aria-label="Settings sections">
            @php
                $settingsTabs = [
                    ['key' => 'profile',       'label' => 'Profile',              'icon' => 'user'],
                    ['key' => 'password',      'label' => 'Password',             'icon' => 'lock'],
                    ['key' => 'notifications', 'label' => 'Notifications',        'icon' => 'bell'],
                    ['key' => 'learning',      'label' => 'Learning Preferences', 'icon' => 'book-open'],
                    ['key' => 'account',       'label' => 'Account',              'icon' => 'settings'],
                ];
                // Add lock icon to icon map inline
            @endphp
            @foreach($settingsTabs as $st)
                <button @click="tab = '{{ $st['key'] }}'"
                        :class="tab === '{{ $st['key'] }}' ? 'dash-settings-nav__item--active' : ''"
                        class="dash-settings-nav__item">
                    @include('components.dashboard.icon', ['name' => $st['icon'], 'size' => 17])
                    {{ $st['label'] }}
                </button>
            @endforeach
        </nav>

        {{-- ══ SETTINGS PANELS ═══════════════════════════════════════ --}}
        <div class="dash-settings-panel-wrap">

            {{-- ── PROFILE ──────────────────────────────────────────── --}}
            <div x-show="tab === 'profile'" x-cloak>
                <form method="POST" action="{{ route('student.settings.profile') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="dash-settings-section">
                        <h3 class="dash-settings-section__title">Profile Information</h3>
                        <p class="dash-settings-section__desc">Update your avatar, name, bio, and learning goals.</p>
                    </div>

                    {{-- Avatar upload --}}
                    <div class="dash-settings-field" x-data="{ preview: '{{ $profile->avatar_url ?? '' }}' }">
                        <label class="dash-settings-label">Profile Photo</label>
                        <div class="flex items-center gap-5">
                            <div class="dash-avatar-preview">
                                <template x-if="preview">
                                    <img :src="preview" alt="Avatar Preview" class="w-full h-full object-cover rounded-2xl">
                                </template>
                                <template x-if="!preview">
                                    @php
                                        $hues = ['bg-lime-100 text-lime-700', 'bg-blue-100 text-blue-700', 'bg-amber-100 text-amber-700', 'bg-purple-100 text-purple-700', 'bg-rose-100 text-rose-700'];
                                        $colorHash = $hues[$user->id % count($hues)];
                                    @endphp
                                    <div class="w-full h-full rounded-2xl flex items-center justify-center text-2xl font-bold {{ $colorHash }}">
                                        {{ $user->initials }}
                                    </div>
                                </template>
                            </div>
                            <div>
                                <label for="avatar-upload" class="dash-btn-outline dash-btn-sm cursor-pointer">
                                    @include('components.dashboard.icon', ['name' => 'upload', 'size' => 15])
                                    Upload Photo
                                </label>
                                <input id="avatar-upload" type="file" name="avatar" accept="image/*" class="hidden"
                                       @change="const f = $event.target.files[0]; if(f) preview = URL.createObjectURL(f)">
                                <p class="text-xs text-gray-400 mt-2">JPG, PNG, WebP · Max 2MB</p>
                            </div>
                        </div>
                    </div>

                    {{-- Name --}}
                    <div class="dash-settings-field">
                        <label class="dash-settings-label" for="name">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                               class="dash-input @error('name') dash-input--error @enderror"
                               placeholder="Your full name">
                        @error('name') <p class="dash-input-error">{{ $message }}</p> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="dash-settings-field">
                        <label class="dash-settings-label" for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                               class="dash-input @error('email') dash-input--error @enderror"
                               placeholder="you@example.com">
                        @error('email') <p class="dash-input-error">{{ $message }}</p> @enderror
                    </div>

                    {{-- Bio --}}
                    <div class="dash-settings-field">
                        <label class="dash-settings-label" for="bio">About Me</label>
                        <textarea id="bio" name="bio" rows="3"
                                  class="dash-input @error('bio') dash-input--error @enderror"
                                  placeholder="Tell tutors a little about yourself…">{{ old('bio', $profile->bio ?? '') }}</textarea>
                        @error('bio') <p class="dash-input-error">{{ $message }}</p> @enderror
                    </div>

                    {{-- Learning Goals --}}
                    <div class="dash-settings-field">
                        <label class="dash-settings-label" for="learning_goals">Learning Goals</label>
                        <textarea id="learning_goals" name="learning_goals" rows="2"
                                  class="dash-input @error('learning_goals') dash-input--error @enderror"
                                  placeholder="What do you want to achieve?">{{ old('learning_goals', $profile->learning_goals ?? '') }}</textarea>
                        @error('learning_goals') <p class="dash-input-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="dash-btn-lime">Save Profile</button>
                    </div>
                </form>
            </div>

            {{-- ── PASSWORD ─────────────────────────────────────────── --}}
            <div x-show="tab === 'password'" x-cloak>
                <form method="POST" action="{{ route('student.settings.password') }}">
                    @csrf

                    <div class="dash-settings-section">
                        <h3 class="dash-settings-section__title">Change Password</h3>
                        <p class="dash-settings-section__desc">Use a strong password — at least 8 characters.</p>
                    </div>

                    <div class="dash-settings-field">
                        <label class="dash-settings-label" for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password"
                               class="dash-input @error('current_password') dash-input--error @enderror"
                               placeholder="Enter your current password">
                        @error('current_password') <p class="dash-input-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="dash-settings-field">
                        <label class="dash-settings-label" for="password">New Password</label>
                        <input type="password" id="password" name="password"
                               class="dash-input @error('password') dash-input--error @enderror"
                               placeholder="New password">
                        @error('password') <p class="dash-input-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="dash-settings-field">
                        <label class="dash-settings-label" for="password_confirmation">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="dash-input"
                               placeholder="Repeat new password">
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="dash-btn-lime">Update Password</button>
                    </div>
                </form>
            </div>

            {{-- ── NOTIFICATIONS ────────────────────────────────────── --}}
            <div x-show="tab === 'notifications'" x-cloak>
                <form method="POST" action="{{ route('student.settings.notifications') }}">
                    @csrf

                    <div class="dash-settings-section">
                        <h3 class="dash-settings-section__title">Notification Preferences</h3>
                        <p class="dash-settings-section__desc">Control how and when Tutzy contacts you.</p>
                    </div>

                    @php
                        $toggles = [
                            ['name' => 'notify_email',            'label' => 'Email Notifications',   'desc' => 'Receive updates via email',                  'value' => $profile->notify_email            ?? true],
                            ['name' => 'notify_sms',              'label' => 'SMS Notifications',     'desc' => 'Get text messages for lesson reminders',     'value' => $profile->notify_sms              ?? false],
                            ['name' => 'notify_lesson_reminders', 'label' => 'Lesson Reminders',      'desc' => '1 hour before every scheduled session',      'value' => $profile->notify_lesson_reminders ?? true],
                            ['name' => 'notify_new_messages',     'label' => 'New Messages',          'desc' => 'When a tutor sends you a message',           'value' => $profile->notify_new_messages     ?? true],
                            ['name' => 'notify_promotions',       'label' => 'Promotions & Offers',   'desc' => 'Deals, new tutors, and Tutzy updates',       'value' => $profile->notify_promotions       ?? false],
                        ];
                    @endphp

                    <div class="flex flex-col gap-2">
                        @foreach($toggles as $toggle)
                            <div class="dash-toggle-row">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $toggle['label'] }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $toggle['desc'] }}</p>
                                </div>
                                <label class="dash-toggle" x-data="{ on: {{ $toggle['value'] ? 'true' : 'false' }} }">
                                    <input type="hidden" :name="'{{ $toggle['name'] }}'" :value="on ? '1' : '0'">
                                    <button type="button" @click="on = !on"
                                            :class="on ? 'dash-toggle__track--on' : 'dash-toggle__track--off'"
                                            class="dash-toggle__track" :aria-checked="on.toString()" role="switch">
                                        <span :class="on ? 'dash-toggle__thumb--on' : 'dash-toggle__thumb--off'"
                                              class="dash-toggle__thumb"></span>
                                    </button>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="dash-btn-lime">Save Preferences</button>
                    </div>
                </form>
            </div>

            {{-- ── LEARNING PREFERENCES ─────────────────────────────── --}}
            <div x-show="tab === 'learning'" x-cloak>
                <form method="POST" action="{{ route('student.settings.learning') }}">
                    @csrf

                    <div class="dash-settings-section">
                        <h3 class="dash-settings-section__title">Learning Preferences</h3>
                        <p class="dash-settings-section__desc">Personalise your learning experience.</p>
                    </div>

                    <div class="dash-settings-field">
                        <label class="dash-settings-label" for="timezone">Timezone</label>
                        <select id="timezone" name="timezone" class="dash-input">
                            @php
                                $zones = ['Asia/Kolkata','UTC','America/New_York','America/Los_Angeles','Europe/London','Europe/Paris','Asia/Dubai','Asia/Singapore','Australia/Sydney'];
                            @endphp
                            @foreach($zones as $tz)
                                <option value="{{ $tz }}" {{ ($profile->timezone ?? 'Asia/Kolkata') === $tz ? 'selected' : '' }}>{{ $tz }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="dash-settings-field">
                        <label class="dash-settings-label" for="preferred_subjects">Preferred Subjects</label>
                        <input type="text" id="preferred_subjects" name="preferred_subjects"
                               value="{{ old('preferred_subjects', $profile->preferred_subjects ?? '') }}"
                               class="dash-input"
                               placeholder="e.g. Mathematics, Physics, Guitar">
                        <p class="text-xs text-gray-400 mt-1.5">Separate with commas</p>
                    </div>

                    <div class="dash-settings-field">
                        <label class="dash-settings-label" for="weekly_goal_hours">
                            Weekly Learning Goal
                            <span class="text-lime-600 font-bold ml-1" id="goal-display">
                                {{ $profile->weekly_goal_hours ?? 5 }}h/week
                            </span>
                        </label>
                        <input type="range" id="weekly_goal_hours" name="weekly_goal_hours"
                               min="1" max="40" step="1"
                               value="{{ old('weekly_goal_hours', $profile->weekly_goal_hours ?? 5) }}"
                               class="dash-range"
                               oninput="document.getElementById('goal-display').textContent = this.value + 'h/week'">
                        <div class="flex justify-between text-xs text-gray-400 mt-1">
                            <span>1h</span><span>40h</span>
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="dash-btn-lime">Save Preferences</button>
                    </div>
                </form>
            </div>

            {{-- ── ACCOUNT (Danger Zone) ────────────────────────────── --}}
            <div x-show="tab === 'account'" x-cloak>
                <div class="dash-settings-section">
                    <h3 class="dash-settings-section__title">Account Settings</h3>
                    <p class="dash-settings-section__desc">Manage account-level actions.</p>
                </div>

                <div class="dash-card p-6 border border-gray-100 mb-5">
                    <div class="flex items-center gap-4">
                        @php
                            $hues = ['bg-lime-100 text-lime-700', 'bg-blue-100 text-blue-700', 'bg-amber-100 text-amber-700', 'bg-purple-100 text-purple-700', 'bg-rose-100 text-rose-700'];
                            $ch   = $hues[$user->id % count($hues)];
                        @endphp
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center font-bold {{ $ch }}">{{ $user->initials }}</div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                        <span class="ml-auto text-xs font-semibold text-lime-700 bg-lime-50 px-3 py-1 rounded-full capitalize">{{ $user->role }}</span>
                    </div>
                </div>

                {{-- Danger zone --}}
                <div class="dash-card p-6 border border-red-100 bg-red-50/50">
                    <h4 class="text-sm font-bold text-red-700 mb-1">Danger Zone</h4>
                    <p class="text-xs text-red-500 mb-4">Deleting your account is permanent and cannot be undone.</p>
                    <button type="button"
                            class="dash-btn-danger dash-btn-sm"
                            onclick="alert('Account deletion will be available in a future update. Contact support if urgent.')">
                        @include('components.dashboard.icon', ['name' => 'trash-2', 'size' => 15])
                        Delete My Account
                    </button>
                </div>
            </div>

        </div>{{-- end panels wrap --}}
    </div>{{-- end settings layout --}}
</div>
@endsection

@push('scripts')
<script>
// Keep settings tab in URL for direct linking
document.querySelectorAll('[\\@click^="tab ="]').forEach(btn => {
    btn.addEventListener('click', function() {
        const match = this.getAttribute('@click').match(/'([^']+)'/);
        if (match) {
            const url = new URL(window.location);
            url.searchParams.set('tab', match[1]);
            window.history.replaceState({}, '', url);
        }
    });
});
</script>
@endpush
