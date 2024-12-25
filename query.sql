-- Create Table: Role
CREATE TABLE Role (
    RoleID INT PRIMARY KEY AUTO_INCREMENT,
    RoleName VARCHAR(255) NOT NULL
);

-- Create Table: Instructor
CREATE TABLE Instructor (
    InstructorID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Phone VARCHAR(20),
    RoleID INT,
    FOREIGN KEY (RoleID) REFERENCES Role(RoleID)
);

-- Create Table: Plan
CREATE TABLE Plan (
    PlanID INT PRIMARY KEY AUTO_INCREMENT,
    PlanName VARCHAR(255) NOT NULL,
    RequiredCredits INT NOT NULL
);

-- Create Table: Course
CREATE TABLE Course (
    CourseID INT PRIMARY KEY AUTO_INCREMENT,
    CourseName VARCHAR(255) NOT NULL,
    Credits INT NOT NULL
);

-- Create Table: PlanCourse (Associative Table for Plan and Course)
CREATE TABLE PlanCourse (
    PlanID INT,
    CourseID INT,
    PRIMARY KEY (PlanID, CourseID),
    FOREIGN KEY (PlanID) REFERENCES Plan(PlanID),
    FOREIGN KEY (CourseID) REFERENCES Course(CourseID)
);

-- Create Table: Student
CREATE TABLE Student (
    StudentID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    PlanID INT,
    FOREIGN KEY (PlanID) REFERENCES Plan(PlanID)
);



-- Create Table: Section
CREATE TABLE Section (
    SectionID INT PRIMARY KEY AUTO_INCREMENT,
    Semester VARCHAR(50) NOT NULL,
    Year INT NOT NULL,
    CourseID INT,
    InstructorID INT,
    FOREIGN KEY (CourseID) REFERENCES Course(CourseID),
    FOREIGN KEY (InstructorID) REFERENCES Instructor(InstructorID)
);

-- Create Table: Enrollment (Associative Table for Student and Section)
CREATE TABLE Enrollment (
    EnrollmentID INT PRIMARY KEY AUTO_INCREMENT,
    NumericMark DECIMAL(5, 2),
    AlphaMark CHAR(2),
    Completed BOOLEAN DEFAULT FALSE,
    StudentID INT,
    SectionID INT,
    FOREIGN KEY (StudentID) REFERENCES Student(StudentID),
    FOREIGN KEY (SectionID) REFERENCES Section(SectionID)
);
-- Create view: StudentProgress
CREATE VIEW StudentProgress AS
SELECT 
    s.StudentID,
    s.PlanID,
    SUM(c.Credits) AS TotalCreditsEarned,
    CASE
        WHEN SUM(c.Credits) >= p.RequiredCredits THEN 'Graduate'
        WHEN SUM(c.Credits) >= (p.RequiredCredits * 0.75) THEN 'Near to Graduate'
        ELSE 'In Progress'
    END AS GraduationStatus
FROM 
    Student s
JOIN 
    Enrollment e ON s.StudentID = e.StudentID
JOIN 
    Section sec ON e.SectionID = sec.SectionID
JOIN 
    Course c ON sec.CourseID = c.CourseID
JOIN 
    Plan p ON s.PlanID = p.PlanID
WHERE 
    e.Completed = TRUE
GROUP BY 
    s.StudentID, s.PlanID;
 
