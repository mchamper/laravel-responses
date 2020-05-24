<?php

return [
    ['code' => 200, 'status' => 401, 'name' => 'Unauthenticated'],
    ['code' => 201, 'status' => 403, 'name' => 'Unauthorized'],
    ['code' => 202, 'status' => 403, 'name' => 'UnauthorizedChannel'],
    ['code' => 203, 'status' => 403, 'name' => 'InvalidCredentials'],
    /* -------------------- */
    ['code' => 210, 'status' => 403, 'name' => 'AppClientInactive'],
    ['code' => 211, 'status' => 403, 'name' => 'AppClientBlocked'],
    /* -------------------- */
    ['code' => 220, 'status' => 403, 'name' => 'SystemUserInactive'],
    ['code' => 221, 'status' => 403, 'name' => 'SystemUserBlocked'],
    ['code' => 222, 'status' => 403, 'name' => 'SystemUserUnverified'],
];
