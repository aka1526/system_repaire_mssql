CREATE TABLE [dbo].[brand](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](200) NULL,
	[status] [nvarchar](50) NULL,
 CONSTRAINT [PK_brand] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[calendar](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[title] [nvarchar](50) NULL,
	[inventory] [nvarchar](50) NULL,
	[start] [datetime] NULL,
	[end] [datetime] NULL,
	[link_url] [nvarchar](50) NULL,
	[color] [nvarchar](50) NULL,
	[type] [nvarchar](50) NULL,
 CONSTRAINT [PK_calendar] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO


CREATE TABLE [dbo].[category](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](200) NULL,
	[status] [nvarchar](50) NULL,
	[updated_at] [nvarchar](50) NULL,
	[created_date] [nvarchar](50) NULL,
 CONSTRAINT [PK_category] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO


CREATE TABLE [dbo].[inventory](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](200) NULL,
	[owner_name] [nvarchar](200) NULL,
	[serial_number] [nvarchar](200) NULL,
	[category] [nvarchar](200) NULL,
	[section] [nvarchar](200) NULL,
	[type] [nvarchar](50) NULL,
	[brand] [nvarchar](50) NULL,
	[photo] [nvarchar](50) NULL,
	[inven_status] [nvarchar](50) NULL,
	[updated_at] [nvarchar](50) NULL,
	[created_at] [nvarchar](50) NULL,
	[expire_date] [nvarchar](50) NULL,
	[os_name] [nvarchar](50) NULL,
	[cpu_model] [nvarchar](50) NULL,
	[ram_model] [nvarchar](50) NULL,
	[hdd_model] [nvarchar](50) NULL,
	[monitor_model] [nvarchar](50) NULL,
	[pm_day] [int] NULL,
 CONSTRAINT [PK_inventory] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[inventory] ADD  CONSTRAINT [DF_inventory_pm_day]  DEFAULT ((0)) FOR [pm_day]
GO


CREATE TABLE [dbo].[osname](
	[os_id] [nvarchar](50) NOT NULL,
	[os_name] [nvarchar](50) NULL,
	[status] [nvarchar](50) NULL,
 CONSTRAINT [PK_osname] PRIMARY KEY CLUSTERED 
(
	[os_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO


CREATE TABLE [dbo].[permission](
	[per_id] [int] IDENTITY(1,1) NOT NULL,
	[per_name] [nvarchar](200) NULL,
 CONSTRAINT [PK_permission] PRIMARY KEY CLUSTERED 
(
	[per_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[preventive](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](200) NULL,
	[status] [nvarchar](50) NULL,
 CONSTRAINT [PK_preventive] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO


CREATE TABLE [dbo].[problem](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](500) NULL,
	[status] [nvarchar](50) NULL,
	[cate_id] [nvarchar](50) NULL,
 CONSTRAINT [PK_problem] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[repair](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[type] [nvarchar](50) NULL,
	[inventory_id] [int] NULL,
	[problem] [nvarchar](200) NULL,
	[repairer] [nvarchar](200) NULL,
	[title] [nvarchar](50) NULL,
	[description] [nvarchar](200) NULL,
	[user_id] [nvarchar](50) NULL,
	[updated_at] [nvarchar](50) NULL,
	[created_at] [nvarchar](50) NULL,
	[user_name] [nvarchar](200) NULL,
	[doc_date] [date] NULL,
	[doc_status] [nvarchar](50) NULL,
	[photo] [nvarchar](50) NULL,
 CONSTRAINT [PK_repair] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[repair_detail](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[repair_id] [int] NULL,
	[status_id] [int] NULL,
	[note] [nvarchar](500) NULL,
	[user_name] [nvarchar](200) NULL,
	[updated_at] [nvarchar](50) NULL,
	[created_at] [nvarchar](50) NULL,
	[per_name] [nvarchar](200) NULL,
	[amount] [int] NULL,
	[breakdown] [int] NULL,
	[inventory_id] [nvarchar](50) NULL,
	[doc_date] [date] NULL,
	[problem_id] [int] NULL,
 CONSTRAINT [PK_repair_detail] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[repair_detail] ADD  CONSTRAINT [DF_repair_detail_amount]  DEFAULT ((0)) FOR [amount]
GO

ALTER TABLE [dbo].[repair_detail] ADD  CONSTRAINT [DF_repair_detail_breakdown]  DEFAULT ((0)) FOR [breakdown]
GO


CREATE TABLE [dbo].[section](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](500) NULL,
	[status] [nvarchar](50) NULL,
	[updated_at] [nvarchar](50) NULL,
	[created_at] [nvarchar](50) NULL,
 CONSTRAINT [PK_section] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO


CREATE TABLE [dbo].[services](
	[row_index] [int] IDENTITY(1,1) NOT NULL,
	[docdate] [date] NULL,
	[inven_id] [int] NULL,
	[borrow_name] [nvarchar](200) NULL,
	[sec_id] [int] NULL,
	[type_name] [nchar](10) NULL,
	[type_in] [int] NULL,
	[type_out] [int] NULL,
	[remark] [nvarchar](500) NULL,
	[doc_refer] [nchar](10) NULL,
	[tel] [nvarchar](50) NULL,
	[create_date_time] [datetime] NULL,
	[due_date] [nvarchar](50) NULL,
	[row_refer] [int] NULL,
 CONSTRAINT [PK_services] PRIMARY KEY CLUSTERED 
(
	[row_index] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO


CREATE TABLE [dbo].[status](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](200) NULL,
 CONSTRAINT [PK_status] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO


CREATE TABLE [dbo].[system](
	[id] [int] NOT NULL,
	[title] [nvarchar](50) NULL,
	[name] [nvarchar](500) NULL,
	[line_token] [nvarchar](100) NULL,
	[updated_at] [nvarchar](50) NULL,
	[created_at] [nvarchar](50) NULL,
	
 CONSTRAINT [PK_system] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO


CREATE TABLE [dbo].[type](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](500) NULL,
	[status] [nvarchar](50) NULL,
	[updated_at] [nvarchar](50) NULL,
	[created_at] [nvarchar](50) NULL,
 CONSTRAINT [PK_type] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO


CREATE TABLE [dbo].[users](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[username] [nvarchar](200) NULL,
	[password] [nvarchar](200) NULL,
	[first_name] [nvarchar](200) NULL,
	[last_name] [nvarchar](200) NULL,
	[gender] [nvarchar](50) NULL,
	[birthdate] [nvarchar](50) NULL,
	[email] [nvarchar](50) NULL,
	[phone_number] [nvarchar](50) NULL,
	[profile] [nvarchar](50) NULL,
	[permission] [nvarchar](50) NULL,
	[status] [nvarchar](50) NULL,
	[updated_at] [nvarchar](50) NULL,
	[created_at] [nvarchar](50) NULL
) ON [PRIMARY]
GO


 


