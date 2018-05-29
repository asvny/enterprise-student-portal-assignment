DROP TABLE Login;

-- Role
-- 0 - Normal User
-- 1 - Administrative User

-- Salt (Defined in env.php)

CREATE TABLE Login (
  id NUMBER GENERATED ALWAYS AS IDENTITY,
  username VARCHAR2(20) NOT NULL,
  password VARCHAR2(50) NOT NULL,
  role Number(1) DEFAULT 0,
  Primary key (id)
);

INSERT INTO Login (username, password, role) VALUES ('admin', 'f18ba77353501eb2695ae8e65bea5622', 1); 
INSERT INTO Login (username, password) VALUES ('guest', 'f18ba77353501eb2695ae8e65bea5622'); 
commit;