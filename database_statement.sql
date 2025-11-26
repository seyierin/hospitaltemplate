DROP TABLE `hms`.`settings`;

CREATE TABLE `settings` (
  `ID` int(11) NOT NULL,
  `meta_name` varchar(250) NOT NULL,
  `meta_value` longtext NOT NULL,
  `meta_for` varchar(250) DEFAULT 'all',
  `is_encypt` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `meta_name` (`meta_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


DROP TABLE `hms`.`roles`;


CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `permissions` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

INSERT INTO `settings` (`ID`, `meta_name`, `meta_value`, `meta_for`, `is_encypt`, `date`) VALUES (NULL, 'roles', 'ewogICAgImRhc2hib2FyZCI6IHsgImxpc3QiOiAiVmlldyBEYXNoYm9hcmQiIH0sCiAgICAic3RhZmYiOiB7ICJsaXN0IjogIlZpZXcgRG9jdG9ycyIsICJhZGQiOiAiQWRkIFN0YWZmIiwgImVkaXQiOiAiRWRpdCBTdGFmZiIgfSwKICAgICJwYXRpZW50IjogeyAibGlzdCI6ICJWaWV3IFBhdGllbnRzIiwgImFkZCI6ICJBZGQgUGF0aWVudCIsICJlZGl0IjogIkVkaXQgUGF0aWVudCIgfSwKICAgICJkZXBhcnRtZW50cyI6IHsgImxpc3QiOiAiVmlldyBEZXBhcnRtZW50cyIsICJhZGQiOiAiQWRkIERlcGFydG1lbnQiLCAiZWRpdCI6ICJFZGl0IERlcGFydG1lbnQiIH0sCiAgICAicm9sZXMiOiB7ICJsaXN0IjogIkFjY2VzcyB0byBsaXN0IG9mIGFsbCByb2xlcyIsICJhZGQiOiAiQWRkIFJvbGUiLCAiZWRpdCI6ICJNb2RpZnkgIFJvbGUiIH0KfQ==', 'all', '0', '2025-11-26 14:45:27');
INSERT INTO `roles` (`ID`, `name`, `permissions`, `status`, `date`) VALUES (NULL, 'Doctors', 'ewogICAgImRhc2hib2FyZCI6IHsgImxpc3QiOiAiVmlldyBEYXNoYm9hcmQiIH0sCiAgICAicGF0aWVudCI6IHsgImxpc3QiOiAiVmlldyBQYXRpZW50cyIsICJhZGQiOiAiQWRkIFBhdGllbnQiLCAiZWRpdCI6ICJFZGl0IFBhdGllbnQiIH0sCiAgICAiZGVwYXJ0bWVudHMiOiB7ICJsaXN0IjogIlZpZXcgRGVwYXJ0bWVudHMiLCAiYWRkIjogIkFkZCBEZXBhcnRtZW50IiwgImVkaXQiOiAiRWRpdCBEZXBhcnRtZW50IiB9LAp9', '1', current_timestamp());
INSERT INTO `roles` (`ID`, `name`, `permissions`, `status`, `date`) VALUES (NULL, 'Nurse', 'ewogICAgImRhc2hib2FyZCI6IHsgImxpc3QiOiAiVmlldyBEYXNoYm9hcmQiIH0sCiAgICAicGF0aWVudCI6IHsgImxpc3QiOiAiVmlldyBQYXRpZW50cyIsICJhZGQiOiAiQWRkIFBhdGllbnQiLCAiZWRpdCI6ICJFZGl0IFBhdGllbnQiIH0sCiAgICAiZGVwYXJ0bWVudHMiOiB7ICJsaXN0IjogIlZpZXcgRGVwYXJ0bWVudHMiLCAiYWRkIjogIkFkZCBEZXBhcnRtZW50IiwgImVkaXQiOiAiRWRpdCBEZXBhcnRtZW50IiB9LAp9', '1', '2025-11-26 15:08:00');