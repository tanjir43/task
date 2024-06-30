# Project Setup and Functionality Details

## Setup Instructions

1. Run database migrations:

2. Install composer dependencies:

3. Compile assets (assuming you're using Jetstream): npm-run-dev


## Panels Overview

### Admin Panel

- Admin can maintain and create events.
- Basic role permissions are implemented statically.

### User Panel

- Users can request to be assigned to upcoming or ongoing events.
- Option to invite other members within their territory (country/city), though not fully implemented.
- Users can view upcoming events and events they are assigned to.

## After Migration

### User Panel

1. **Requesting Event Assignments:**
Users can request to be assigned to events that are upcoming or ongoing.

2. **Invitations:**
Users have the option to invite other members within their territory (country/city), which is optional and not fully implemented.

3. **Event Viewing:**
Users can view upcoming events and events they are specifically assigned to.

### Admin Panel

1. **Managing Areas:**
Admin can manage areas for sending reminders, grouped by gender, although this feature is not fully implemented.

2. **Assigning Events:**
Admin can assign events based on territory (country/city) or without specifying territory.

3. **Event Assignment and Reminders:**
In the event assignment process, an icon indicates whether to send an email reminder to the user, though this functionality is not fully operational.

4. **Reminder Scheduling:**
Admin can schedule reminders based on the `EventReminder` `reminder_time` field.

---

Thank you.

