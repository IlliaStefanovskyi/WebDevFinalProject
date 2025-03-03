SELECT * 
FROM bookings b 
INNER JOIN cats c ON b.catId = c.catId 
INNER JOIN users u ON b.userId = u.userId;

