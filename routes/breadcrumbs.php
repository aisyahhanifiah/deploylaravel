<?php
use App\Club;
use App\Event;
use App\Meeting;
use App\User;
// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

// Home > MyClub
Breadcrumbs::register('myclub.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('My Clubs', route('myclub.index'));
});

// Home > Payment
Breadcrumbs::register('payment.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('My Payment', route('payment.index'));
});

// Home > Payment > Club > {Payment}
Breadcrumbs::register('payment.show1', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('payment.index');
    $club = Club::findOrFail($id);
    $breadcrumbs->push('Receipt for ' . $club->name, route('payment.show1', $club));
});

// Home > Payment > Event > {Payment}
Breadcrumbs::register('payment.show2', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('home');
    $event = Event::findOrFail($id);
    $breadcrumbs->push('Receipt for ' . $event->name, route('payment.show2', $event));
});

// Home > Event
Breadcrumbs::register('event.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Event', route('event.index'));
});

// Home > Event
Breadcrumbs::register('event.show', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('event.index');
    $event = Event::findOrFail($id);
    $breadcrumbs->push($event->name, route('event.show', $event));
});

// Home > Club
Breadcrumbs::register('club.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Club', route('club.index'));
});

// Home > Club
Breadcrumbs::register('club.show', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('club.index');
    $club = Club::findOrFail($id);
    $breadcrumbs->push($club->name, route('club.show', $club));
});

// Home > Participation
Breadcrumbs::register('myevent.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('My Participations', route('myevent.index'));
});


// Home > Committee > Manage Clubs
Breadcrumbs::register('committee.club.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Manage Clubs', route('committee.club.index'));
});

// Home > Committee > Manage Club Member
Breadcrumbs::register('committee.club.member', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('committee.club.index');
    $club = Club::findOrFail($id);
    $breadcrumbs->push($club->name, route('committee.club.member.show', $club));
});

// Home > Committee > Manage Club > Edit
Breadcrumbs::register('committee.club.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('committee.club.index');
    $club = Club::findOrFail($id);
    $breadcrumbs->push('Edit Club - ' . $club->name, route('committee.club.edit', $club));
});

// Home > Committee > Manage Events
Breadcrumbs::register('committee.event.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Manage Events', route('committee.event.index'));
});

// Home > Committee > Manage Event Member
Breadcrumbs::register('committee.event.member', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('committee.event.index');
    $event = Event::findOrFail($id);
    $breadcrumbs->push($event->name, route('committee.event.member.show', $event));
});

// Home > Committee > Manage Event > Edit
Breadcrumbs::register('committee.event.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('committee.event.index');
    $event = Event::findOrFail($id);
    $breadcrumbs->push('Edit Event - ' . $event->name, route('committee.event.edit', $event));
});

// Home > Committee > Manage Event > Create
Breadcrumbs::register('committee.event.create', function ($breadcrumbs) {
    $breadcrumbs->parent('committee.event.index');
    $breadcrumbs->push('Create Event', route('committee.event.create'));
});

// Home > Committee > Manage Meetings
Breadcrumbs::register('committee.meeting.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Manage Meetings', route('committee.meeting.index'));
});

// Home > Committee > Manage Meeting Member
Breadcrumbs::register('committee.meeting.member', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('committee.meeting.index');
    $meeting = Meeting::findOrFail($id);
    $breadcrumbs->push($meeting->name, route('committee.meeting.member.show', $meeting));
});

// Home > Committee > Manage Meeting > Edit
Breadcrumbs::register('committee.meeting.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('committee.meeting.index');
    $meeting = Meeting::findOrFail($id);
    $breadcrumbs->push('Edit Meeting - ' . $meeting->name, route('committee.meeting.edit', $meeting));
});

// Home > Committee > Manage Meeting > Create
Breadcrumbs::register('committee.meeting.create', function ($breadcrumbs) {
    $breadcrumbs->parent('committee.meeting.index');
    $breadcrumbs->push('Create Meeting', route('committee.meeting.create'));
});


// Home > Admin > Manage Clubs
Breadcrumbs::register('admin.club.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Manage Clubs', route('admin.club.index'));
});

// Home > Admin > Manage Club Member
Breadcrumbs::register('admin.club.member', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.club.index');
    $club = Club::findOrFail($id);
    $breadcrumbs->push($club->name, route('admin.club.member.show', $club));
});

// Home > Admin > Manage Club > Edit
Breadcrumbs::register('admin.club.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.club.index');
    $club = Club::findOrFail($id);
    $breadcrumbs->push('Edit Club - ' . $club->name, route('admin.club.edit', $club));
});

// Home > Admin > Manage Club > Create
Breadcrumbs::register('admin.club.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.club.index');
    $breadcrumbs->push('Create Club', route('admin.club.create'));
});

// Home > Admin > Manage Events
Breadcrumbs::register('admin.event.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Manage Events', route('admin.event.index'));
});

// Home > Admin > Manage Event Member
Breadcrumbs::register('admin.event.member', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.event.index');
    $event = Event::findOrFail($id);
    $breadcrumbs->push($event->name, route('admin.event.member.show', $event));
});

// Home > Admin > Manage Event > Edit
Breadcrumbs::register('admin.event.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.event.index');
    $event = Event::findOrFail($id);
    $breadcrumbs->push('Edit Event - ' . $event->name, route('admin.event.edit', $event));
});

// Home > Admin > Manage Event > Create
Breadcrumbs::register('admin.event.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.event.index');
    $breadcrumbs->push('Create Event', route('admin.event.create'));
});

// Home > Admin > Manage Users
Breadcrumbs::register('admin.user.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Manage Users', route('admin.user.index'));
});

// Home > Admin > Manage User > Edit
Breadcrumbs::register('admin.user.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.user.index');
    $user = User::findOrFail($id);
    $breadcrumbs->push('Edit User - ' . $user->name, route('admin.user.edit', $user));
});

// Home > Admin > Manage User > Create
Breadcrumbs::register('admin.user.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.user.index');
    $breadcrumbs->push('Create User', route('admin.user.create'));
});
// Home > Blog
// Breadcrumbs::register('blog', function ($breadcrumbs) {
//     $breadcrumbs->parent('home');
//     $breadcrumbs->push('Blog', route('blog'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::register('category', function ($breadcrumbs, $category) {
//     $breadcrumbs->parent('blog');
//     $breadcrumbs->push($category->title, route('category', $category->id));
// });

// // Home > Blog > [Category] > [Post]
// Breadcrumbs::register('post', function ($breadcrumbs, $post) {
//     $breadcrumbs->parent('category', $post->category);
//     $breadcrumbs->push($post->title, route('post', $post));
// });