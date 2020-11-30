Search Code base for TODO

### Business Logic Rules

-   [ ] Buyers must be approved before they can see create parts requests
-   [ ] Suppliers cannot see parts requests that they cannot supply
-   [ ] Suppliers can only bid on parts requests that are not "expired"
-   [ ] Suppliers cannot edit their bids
-   [ ] Suppliers cannot see the identity of the buyer

### Views to be reviewed

-   Can I get rid of `/views/bids/show` and `/views/bids/index`?

Maybe, but it will probably be needed in stage 3 where bids are confirmed, and more functions are added to it.

### Example Postcode input

`CB1,CM17,IP26,SG8,PE27,EN11,CB10,CM18,IP27,SG9,PE28,CB11,CM19,IP28,SG10,CB21,CM20,IP29,SG11,CB22,CM21,SG12,CB23,CM22,SG13,CB24,CM23,SG14,CB25,CM24,SG19,CB3,CM6,CB4,CM7,CB5,CB6,CB7,CB8,CB9`

### Questions for Helge

-   How do I avoid the conditionals in `parts-requests/index.blade.php`? `@can()` directive?

-   Should I break a view up into partials so it's more readable even though those sections aren't being repeated?

-   What's best practice for partials within a sub-directory. e.g. `/views/parts-requests/show.blade.php`?

    -   Option 1: `/views/parts-requests/partials/bids.blade.php`
    -   Option 2: `/views/partials/parts-request/bids.blade.php`
    -   Option 3: Leave in the root blade template.

-   How to get users to add postcodes_covered and how to save in DB?

-   User model getting too fat because of different roles: admin, supplier, buyer.

-   Check setting user roles from model method: `User::setRole()`?

-   "Can a user create a bid on a parts request" - which model? `\App\User->supplierCanBid($partsRequest)` Maybe a Policy?

-   `\App\Bid::getStatus()` is based on some conditionals i.e. has another biod been accepted? has this been accepted but not "confirmed"?

-   `\App\PartsRequest::getStatus()` same as above, is it expired? Is it completed ( has confirmed bid )?

-   Should make the routes: `parts-requests/{partsRequest}/bids/` and `parts-requests/{partsRequest}/bid/{bid}`

-   How to show statuses with different css, icon and text? `views/lang` or `@include( 'status.' . $partsRequest->status() )`

## Dropzone

-   The dropzone is created programatially ( https://www.dropzonejs.com/#create-dropzones-programmatically )
-   The dropzone is created in standard javascript object so I can easily chain events on the send such as `partsImagesDropzone.emit`

Because I am using it as part of a larger form, the logic is as follows:

1. As a new image is dragged in or selected there is an AJAX request to `PartsRequestImageController` ( without posting the entire form )
2. The controller validates and saves the image to storage then returns the filename
3. The `success` handler appends a hidden `input` with the file name in it to the main form
4. If the file is **removed** before the form is submitted there is an additional step to remove the newly created hidden input using its `data-file-reference` attribute.
5. If the entire form is posted and fails, the `old()` hidden inputs get regenerated in a loop with the `data-file-reference` so they can be taregted for removal.
6. There is also a jQuery loop which creates image thumbnails in the dropzone for each of the old values and attaches the filenames to the `data-file-reference`.
7. If the `old()` image is deleted the same `data-file-reference` is used to remove the hidden input.

## Part Request Statuses

Is there a case for two types of status, at least for the supplier? e.g. :

-   **Status**: Open, Expired, Pending, Completed
-   **Decision**: Waiting, Rejected, Accepted, Waiting Confirmation

#### Standard procedure

1. Buyer creates a Parts Request

-   Buyer | Parts Request: Waiting for bids
-   Supplier | Parts Request: Submit a quote

2. Supplier bids on Parts Request

-   Supplier | Parts Request: Quoted
-   Buyer | Parts Request: 1 Bid

3. Supplier2 bids on Parts Request

-   Supplier2| Parts Request: Quoted
-   Buyer | Parts Request: 2 Bids

4. Buyer accepts Supplier2's bid

-   Buyer | Parts Request: A bid was accepted ( by Supplier2 ) / Waiting delivery confirmation
-   Supplier1| Parts Request: Your bid was rejected
-   Supplier2| Parts Request: Your bid was accepted ( maybe with amendments )

5. Supplier confirms delivery

-   Buyer | Parts Request: Delivery confirmed
-   Supplier2| Parts Request: You have confirmed delivery

6. After delivery date passed

-   Buyer | Parts Request: Completed
-   Supplier2| Parts Request: Completed

7. Noone bids on the Parts Request

-   Buyer: Parts Request: Expired without bids

8. Bids created but none accepted

-   Buyer: Parts Request: Expired no bids accepted

9. Bids created but none accepted

-   Buyer: Parts Request: Expired no bids accepted

#### Buyer

-   Open : Bidding is open, no bid accepted.
-   Expired : Expired. No bid provided.
-   Bid Accepted : Bid accepted, not yet confirmed by supplier.
-   Pending : Expired. Pending buyer acceptance or rejection of one of the bids.
-   Confirmed / Completed : Bid accepted, confirmed. Done. Tick?

#### Supplier

-   Open : You are eligible to bid.
-   Expired : You can no longer bid / ran out of time.
-   Bidded : You can no longer bid / you already bid.
-   Pending : The bidding window has expired and you are waiting the buyer to accept / reject.
-   Bid Won : Your bid was accepted. You need to confirm your delivery time.
-   Rejected : Another bid was accepted.
-   Completed : Bid confirmed. Done. Tick?

---

## User Journey Run Through

#### Buyer and Supplier Journey

-   [ ] Guest can register
-   [ ] Admins receives email
-   [ ] Admin can activate
-   [ ] Buyer recieves email
-   [ ] Buyer can login
-   [ ] Buyer can create new part type
-   [ ] Buyer can upload images
-   [ ] Buyer can remove images
-   [ ] Buyer can submit new Part Request
-   [ ] Eligible suppliers should receive email notification
-   [ ] Supplier can upload images to bid line
-   [ ] Supplier can delete bid lines
-   [ ] Supplier has to confirm bid
-   [ ] Supplier can back out of confirmation
-   [ ] Supplier is redirected after bid success
-   [ ] Owner buyer recieves email notification
-   [ ] Owner can view bid
-   [ ] Suppliers cannot view other bids
-   [ ] Buyer can reject bid lines
-   [ ] Buyer can accept the bid
-   [ ] Accepted supplier emailed with success
-   [ ] Rejected supplier emailed with notification
-   [ ] Accepted supplier can confirm delivery
-   [ ] Rejected suppliers can vciew the parts request and their bid but nothing else
-   [ ] Owner buer gets a notification of confirmed delivery time

#### User Management

-   [ ] Admins can create new supplier
-   [ ] New user recieves a new account email
-   [ ] New user can login and submit bids
-   [ ] Admins can suspend a user
-   [ ] Suspended users cannot login
-   [ ] Deleted users are deleted
