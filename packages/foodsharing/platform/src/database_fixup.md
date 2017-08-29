# Database Fixup
The current database has broken foreign key relationships:
 - No foreign key relationships defined
 - No ON DELETE triggers (as well as no programatic deletion)
 - The wish for some invalid data to be there, for some not.

## What should be done?
The goal is to get the database free from logic errors, so an ORM can handle it.
The most important tables for now are
 - fs_foodsaver
 - fs_betrieb
 - fs_betrieb_team
 - fs_bezirk
 - fs_conversation
 - fs_foodsaver_has_conversation
 - fs_msg

# Table-by-table analysis
## fs_abholer
Stores filled pickup slots, references foodsaver_id betrieb_id
Needed to generate statistics (count, but not weight).

### todo
Have deleted entries from *fs_foodsaver* and *fs_betrieb* reappear.
Hide deleted fs_betrieb on existing map
Don't care about that in existing code. Used to show pickup history, but broken old entries seem fine.

## fs_abholzeiten
Stores recurring, total pickup slots, references betrieb_id

### todo
Remove all non-existent references to *fs_betrieb*, add `ON DELETE CASCADE`.
Add foreign key relationship to *fs_betrieb*
Reasoning: The data only affects future pickups that will not occur in case a store is removed.

## fs_answer
Stores answers to quiz.

### todo
Nothing. Maybe add foreign key relationship to *fs_question* as well as `ON DELETE CASCADE`.
Reasoning: Answers to removed questions are not needed, existing quiz sessions get a copy in `fs_quiz_session.quiz_result`.

## fs_apitoken
Stores tokens that are currently only used to get an ICAL calendar of future events/pickups.

### todo
Remove tokens for not existing users, add foreign key relationship to *fs_foodsaver* as well as `ON DELETE CASCADE`.

## fs_application_has_wallpost
Link table between applications (for groups) and the wallposts. *Design broken*: Links foodsaver ids to the wallposts, e.g. all applications a foodsaver does to somewhere

### todo
Remove entries for non-existing users, add `ON DELETE CASCADE` to *fs_foodsaver*.
Remove entries for non-existing wallposts, add `ON DELETE CASCADE` to *fs_wallpost*
Reasoning: Applications texts for deleted users are not useful anymore

## fs_basket
Lists all foodbaskets.

### todo
Check code to never display foodbaskets from removed users except to admins.

## fs_basket_anfrage
Lists foodbasket requests.

### todo
Remove entries for non-existing users, add `ON DELETE CASCADE` to *fs_foodsaver*.
Remove entries for non-existing baskets, add `ON DELETE CASCADE` to *fs_basket*.
Reasoning: Requests for non existant users do not need to be kept, basket FK is purely defensive.

## fs_basket_has_art
Combines foodbaskets with different types of food. *Unused*: Has to be entered but is never evaluated.

### todo
remove in code (in future), leave database as is (for now)

## fs_basket_has_types
See fs_basket_has_art

## fs_basket_has_wallpost
Link table between baskets and the wallposts (public)

### todo
Remove entries for non-existing wallposts, add `ON DELETE CASCADE` to *fs_wallpost*
Remove entries for non-existing baskets, add `ON DELETE CASCADE` to *fs_basket*
Reasoning: It is just a link table, remove entries where data is missing.

## fs_bell
Stores arbitrary notifications

## fs_betrieb
Stores stores.

### todo
Conversation 108242 and 108243 missing (store 1, 2) (fixed, inserted)

### later todo
Link `bezirk_id` to *fs_bezirk*
Care about kette_id, betrieb_kategorie_id

## fs_betrieb_notiz
Stores wallposts on stores (independent of wallpost system)

### todo
Have deleted entries from *fs_foodsaver* and *fs_betrieb* reappear.

## fs_betrieb_team
Stores team membership as well as statistics in stores.

### todo
Have deleted entries from *fs_foodsaver* and *fs_betrieb* reappear.

## fs_bezirk
Stores districts as well as workinggroups (differentiated by type column) (referred to as "group" or "district" in this document)

### later todo
Remove unused columns email_pass, conversation_id

## fs_bezirk_has_theme
Forum: Relates threads to groups.

### todo
remove broken entries
add foreign key relationsips on *fs_theme* and *fs_bezirk* with `ON DELETE CASCADE` trigger.

## fs_bezirk_has_wallpost
remove broken entries
add foreign key relationships on *fs_bezirk* and *fs_wallpost* with `ON DELETE CASCADE` trigger.

## fs_blog_entry
Stores blog entries (there is a /news URL)

### later todo
Think about

## fs_botschafter
Notes the ambassador/admin attribute on a group membership.

### todo
remove broken entries
add foreign key relationships on *fs_bezirk* and *fs_foodsaver*

## fs_buddy
"I know XY" connection/friendship relation.

### todo
investigate, why there are lots of "0" entries
remove broken entries
add foreign key relationships on *fs_foodsaver* with `ON DELETE CASCADE` trigger

## fs_contact
Stores email addresses gathered from incoming/outgoing emails that will be used for autocompletion.

## fs_content
"Mini-CMS" content table that is used to generate some pages as well as sections on some pages.

## fs_conversation
Conversation table

### todo

### later todo
get rid of API module,
switch over to foodsharing-API backend to get rid of denormalized columns.
By that, also stop htmlentities encoding. On the decoding side, implement time aware message body decoders.
Denormalized fields usage: listConversations (member, last)
remove last_foodsaver_id (unused, easy)
remove start_foodsaver_id (unused, very easy)
remove start (unused, very easy)
remove heartbeat code (that is not used since we have socket.io)

## fs_email_blacklist
Contains email addresses that are not allowed to signup (needs database admin to maintain)

## fs_email_status
Mass mailer status table (per-recipient status)

### todo
remove broken entries
add foreign key relationships to *fs_foodsaver* and *fs_email* with `ON DELETE CASCADE`

## fs_event
Contains all events

### todo
Regain missing users
Check code fetching events to properly handle deleted users
remove broken entries for fs_bezirk by setting them NULL, add foreign key relationship to *fs_bezirk* (on delete set NULL)
add foreign key relationship to *fs_location* (nullable)

## fs_event_has_wallpost
Links wallposts on event (only communication channel for an event)

### todo
Remove broken entries
add foreign key relationships to *fs_event* and *fs_wallpost*, `ON DELETE CASCADE`

## fs_fairteiler
Lists fair share points

### todo
Null broken entries (should still be listable in map)
add foreign key relationship to *fs_bezirk*

## fs_fairteiler_follower
Links follower/responsible to fairsharepoints

### todo
Remove broken entries
add foreign key relationships to *fs_foodsaver* and *fs_fairteiler* with `ON DELETE CASCADE`

## fs_fairteiler_has_wallpost
Links wallposts to fair share points

### todo
Remove broken entries
add foreign key relationship to *fs_fairteiler*, *fs_wallpost* with `ON DELETE CASCADE`
check code that handles wallpost display to see how NULL foodsavers are handled.
Reasoning: Keep wallposts from deleted users.

## fs_faq
Questions and answers

### later todo
Care later

## fs_faq_category

## fs_fetchdate
Stores non-recurring pickup slots (just the slot, no fetcher information)

### todo
reinsert missing stores

## fs_foodsaver
User

## todo
add deleted_at column

### todo later
bezirk_id ("home district") is 0 for a lot of users. Should be NULL. As we don't need this soon in new backend, care later.

## fs_foodsaver_archive
Archive table to hold removed users for admin purposes

### todo
Move to fs_foodsaver_archive3,
Recreate with same structure as fs_foodsaver

## fs_foodsaver_change_history
Logs all changes to personal data in foodsaver  table

### later todo
Do not use indices as this should persist deletions (as one reason for it was to be able to detect abuse)

## fs_foodsaver_has_bell
Stores bell <-> user relationship

### todo
Remove broken data
Add foreign key relationships to *fs_foodsaver* and *fs_bell*

## fs_foodsaver_has_bezirk
Stores group/district/working group membership

### todo
Remove broken data
Add foreign key relationships to *fs_foodsaver* and *fs_bezirk*

## fs_foodsaver_has_contact
Relates contacts (email addresses, see above) to users

### todo
Remove broken data,
Add FK to *fs_foodsaver*, *fs_contact*

## fs_foodsaver_has_conversation
Relates conversations to foodsavers.
Care: It is also used to look up conversations by user

### todo
Reinsert missing foodsaver, add FK to *fs_conversation* (not to user)
Fix code to handle deleted users correctly

## fs_foodsaver_has_event
Relates users to events.

### todo
Remove broken data, FK on *fs_foodsaver*, *fs_event*, `ON DELETE CASCADE`

## fs_foodsaver_has_fairteiler
Empty table

### todo
Delete

## fs_foodsaver_has_fetchdate
Empty table

### todo
Delete

## fs_foodsaver_has_wallpost
Wallposts on user profile

### todo
Remove broken data
FK on *fs_foodsaver*, *fs_wallpost*, `ON DELETE CASCADE`

## fs_fsreport_has_wallpost
Stores notes on abuse reports

### todo
remove broken data
FK on *fs_report*, *fs_wallpost*, `ON DELETE CASCADE`

## fs_kette
Store chains

## fs_lebensmittel
Store different kinds of food to be linked with individual stores. Only ever implemented as setter, don't care for now.

## fs_mailbox
Stores mailbox names (for email mailboxes)

## fs_mailbox_member
Maps additional mailbox access for users (e.g. granting custom mailboxes or group ones)

### todo
Remove brokendata,
FK on *fs_mailbox*, *fs_mailbox_member*, `ON DELETE CASCADE`

## fs_mailbox_message
emails

### todo
remove brokendata
FK on *fs_mailbox*, `ON DELETE CASCADE`

## fs_mailchange
Requests to change the emailaddress

### todo
Remove broken / old data
FK on *fs_foodsaver*, `ON DELETE CASCADE`

### todo later
There is a recent entry with foodsaver_id = 0. How did that get here?

## fs_message_tpl
Email templates

### todo later
language switcher implementation is unused and broken

## fs_msg
Conversation messages

### todo
Remove broken data (conversations), readd missing users
FK on *fs_conversation*, `ON DELETE CASCADE`

## fs_pass_gen
Logs which ID cards have been generated

### todo
remove broken data (foodsaver_id), readd missing (bot_id)
FK for foodsaver_id, `ON DELETE CASCADE`

### todo later
handle emtpy users correctly (bot_id)

## fs_pass_request
Password change/forgot requests

### todo
remove broken/old data
FK for foodsaver_id, `ON DELETE CASCADE`

## fs_question
Questions (for quiz)

## fs_question_has_quiz
Relates questions <-> quiz

### todo
remove broken data
FK to *fs_quiz*, *fs_question*, `ON DELETE CASCADE`

## fs_question_has_wallpost
Relates wallposts to questions

### todo
remove broken data
FK to *fs_question*, *fs_wallpost*, `ON DELETE CASCADE`

## fs_quiz_session
Each try (by users) of a quiz ("session")

### todo
remove broken data

## fs_rating
Stores trust bananas

### todo
remove broken data (as we don't want to have trust bananas from/for deleted users)
Add FK

## fs_stat_abholmengen
Stores statistics per store (maybe broken implementation?)

### todo
add FK to store

## fs_theme
forum themes

### todo
nothing as threads from deleted users should be kept

## fs_theme_follower
stores who follows themes

### todo
remove broken data (as follower information is irrelevant for broken XY)
Add FK

## fs_theme_post
Stores posts in themes

### todo
Recreate users
Remove broken data (for themes, not users)

Add FK to themes

## fs_usernotes_has_wallpost
connects organotes on users with wallposts

### todo
recreate missing users
remove broken entries (for wallposts)
