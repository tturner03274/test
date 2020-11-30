<?php

use Illuminate\Database\Seeder;

class PartTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            "A/C Assembly",
            "A/C Compressor",
            "A/C Cooling Module",
            "A/C Dryer",
            "A/C Evaporator",
            "A/C Expansion Valve",
            "A/C Hoses",
            "A/C Radiator",
            "A/C Radiator Fan",
            "Abs Booster Assembly",
            "Abs Pump/Modulator",
            "Abs Sensor",
            "Accelerator Pedal",
            "Accelorometer-A.Susp",
            "Active Susp Ram (Front)",
            "Adblue Tank",
            "Aftermarket Susp Kits",
            "Air Cleaner/Box",
            "Air Filter",
            "Air Filter Pipe",
            "Air Flow Meter",
            "Air Guide (Front)",
            "Air Pump",
            "Air Ride Compressor",
            "Air Solenoid Valve",
            "Air Vents Centre",
            "Airbag (In Steering Wheel)",
            "Airbag (Knee)",
            "Airbag (Left)",
            "Airbag (Right)",
            "Airbag Kit",
            "Airbag Sensor",
            "Airbag Squib/Slip Ring",
            "Alarm",
            "Alpine Light",
            "Alternator",
            "Amplifier Unit",
            "Antenna/Aerial",
            "Anti Roll Bar",
            "Anti Roll Bar Link",
            "A-Post (Left)",
            "A-Post (Right)",
            "Armrest",
            "Ashtray",
            "Axle / Dead Axle (Rear) (Fwd)",
            "Axle Assembly (Front)",
            "Axle Assembly (Rear)",
            "Axle Housing",
            "Badges",
            "Battery",
            "Battery Cover",
            "Battery Terminal",
            "Battery Tray",
            "Bearing",
            "Bed/Box",
            "Bedliner",
            "Bell Housing",
            "Belly Pan",
            "Bodyshell",
            "Bolt/Screw/Nut",
            "Bonnet",
            "Bonnet Grille",
            "Bonnet Hinge",
            "Bonnet Latch",
            "Bonnet Release",
            "Bonnet Shock",
            "Bonnet Soundproofing",
            "Boot",
            "Boot Cargo Area Net",
            "Boot Cover - Low Level",
            "Boot Floor",
            "Boot Foam",
            "Boot Side Panel",
            "Boot Tray - Plastic",
            "Bootlid",
            "Bootlid Button",
            "Bootlid Handle",
            "Bootlid Struts/Rams",
            "Bootlid/Tailgate Hinge",
            "Bootlid/Tailgate Lock",
            "Bottom Yoke",
            "B-Post (Left)",
            "B-Post (Right)",
            "Brake Cable",
            "Brake Caliper",
            "Brake Caliper Hanger",
            "Brake Comp Valve",
            "Brake Disc/Drum (Front)",
            "Brake Disc/Drum (Rear)",
            "Brake Fluid",
            "Brake Fluid Cover",
            "Brake Hose",
            "Brake Kit",
            "Brake Lever",
            "Brake Light Switch",
            "Brake Pads",
            "Brake Pedal",
            "Brake Prop Valve",
            "Brake Servo",
            "Brake Shoes",
            "Brake Slave Cylinder",
            "Brake Switch",
            "Bulb Holder (Left)",
            "Bulb Holder (Right)",
            "Bulkhead (Front)",
            "Bulkhead (Rear)",
            "Bullbars",
            "Bumper (Front)",
            "Bumper (Front) Bracket",
            "Bumper (Front) End Cap",
            "Bumper (Front) Reinforc",
            "Bumper (Front) Shock",
            "Bumper (Rear)",
            "Bumper (Rear) Bracket",
            "Bumper (Rear) End Cap",
            "Bumper (Rear) Reinforc",
            "Bumper (Rear) Shock",
            "Bumper Moulding",
            "Bumper Under-Tray",
            "Bumpstops",
            "Cab Corner",
            "Cabin Filter",
            "Cable",
            "Camera",
            "Camper Shell",
            "Camshaft",
            "Camshaft Housing",
            "Camshaft Sensor",
            "Capstan Winch",
            "Carburettor",
            "Carpet",
            "Catalytic Converter",
            "Cd Changer",
            "Cent/Lock Control Unit",
            "Cent/Lock Motor",
            "Cent/Lock Vacuum Pump",
            "Cent/Locking Solenoid",
            "Chain Guard",
            "Charcoal Filter",
            "Chassis",
            "Chassis Brain Box",
            "Check Strap",
            "Cigarette Lighter",
            "Climate Control Module",
            "Climate Control Panel Digital",
            "Clip (Rear)",
            "Clip On (Left)",
            "Clip On (Right)",
            "Clock",
            "Clock Set",
            "Clutch Basket",
            "Clutch Cable",
            "Clutch Disc",
            "Clutch Kit",
            "Clutch Lever",
            "Clutch Master Cylind",
            "Clutch Pedal",
            "Clutch Plates",
            "Clutch Slave Cylinder",
            "Clutch Switch",
            "Coil Spring (Front)",
            "Coil Spring (Rear)",
            "Coil/Coil Pack",
            "Coin Tray",
            "Combination Switch",
            "Complete Vehicle",
            "Con Rod",
            "Concentric Slave Cylinder",
            "Condenser",
            "Connecting Rod",
            "Console",
            "Conv. Boot Cover",
            "Conv. Lift Motor",
            "Convenience Module",
            "Coolant Temp Sensor",
            "Courtesy Light",
            "Crankshaft",
            "Crankshaft Pulley",
            "Crankshaft Sensor",
            "Crossmember (Front)",
            "Cruise Control Unit",
            "Cubby Box",
            "Cup Holder",
            "Cush Drive",
            "Cush Drive Rubbers",
            "Cv Joint",
            "Cylinder Block",
            "Cylinder Head",
            "Cylinder Head Bolt Set",
            "Cylinder Head Gasket",
            "Cylinder Liners",
            "Dash Assembly",
            "Dash Cover",
            "Dash Lid",
            "Dash Lid Centre Panel",
            "Dash Light Panel",
            "Dash Rubber",
            "Dash Trim",
            "Def Reservoir",
            "Diesel Particulate Filter (Dpf)",
            "Differential Assy",
            "Dipstick",
            "Distributor",
            "Distributor Cap",
            "Diverter Valve",
            "Dog Guard",
            "Door (Front/Left)",
            "Door (Front/Right)",
            "Door (Rear/Left)",
            "Door (Rear/Right)",
            "Door Handle",
            "Door Hinge",
            "Door Lock Assembly",
            "Door Mirror (Left)",
            "Door Mirror (Right)",
            "Door Mirror Support (Left)",
            "Door Mirror Support (Right)",
            "Door Panel",
            "Door Seal",
            "Door Trim Exterior (Front/Left)",
            "Door Trim Exterior (Front/Left)",
            "Door Trim Exterior (Rear/Right)",
            "Door Trim Exterior (Rear/Right)",
            "Door Trim Panel Rear (Left)",
            "Door Trim Panel Rear (Right)",
            "Door Van (Rear) Door Handle",
            "Door Van (Rear) Door Hinge",
            "Door Van (Rear) Door Interior Handle",
            "Door Van (Rear) Door Locking Mech",
            "Door Van (Rear/Left)",
            "Door Van (Rear/Right)",
            "Door Window (Front/Left)",
            "Door Window (Front/Right)",
            "Door Window (Rear/Left)",
            "Door Window (Rear/Right)",
            "Door Window Motor (Front/Left)",
            "Door Window Motor (Front/Right)",
            "Door Window Motor (Rear/Left)",
            "Door Window Motor (Rear/Right)",
            "Down Pipe",
            "Dpf",
            "Drag Link",
            "Driveshaft (Left)",
            "Driveshaft (Right)",
            "Ecu",
            "Ecu & Transponder",
            "Ecu (Engine)",
            "Ecu, Key Card & Bsi Unit",
            "Egr Valve/Cooler",
            "Elect.Window Switch",
            "Electric Handbrake Assembly",
            "Electric Mirror/Fog Switch Bank",
            "Electric Rear Blind, Switch & Motor",
            "Electric Roof Motor ",
            "Electric Seat Motor",
            "Electrics Cover",
            "Engine (Excl. Ancills)",
            "Engine (Excl. Ancills) Petrol",
            "Engine (Excl. Ancills) Petrol Hybrid",
            "Engine Cooling Motor",
            "Engine Cover",
            "Engine Crossmember",
            "Engine Mount",
            "Engine Pipe/Hose",
            "Engine Sensor",
            "Engine Under Tray",
            "Epa Charge",
            "Evaporator Housing",
            "Exhaust Back Box",
            "Exhaust Back Box + Mid Section",
            "Exhaust Bracket",
            "Exhaust Covers/Sheilds",
            "Exhaust Down Pipe",
            "Exhaust Heat Shield",
            "Exhaust Manifold",
            "Exhaust System",
            "Exhaust Valve",
            "Expansion Bottle Cap",
            "Exterior Body Trim",
            "Eyebrow/Surround",
            "Fairing - Lower (Left)",
            "Fairing - Lower (Right)",
            "Fairing - Middle (Left)",
            "Fairing - Middle (Right)",
            "Fairing - Tail",
            "Fairing - Top (Front/Left)",
            "Fairing - Top (Front/Right)",
            "Fairing (Rear/Left)",
            "Fairing (Rear/Right)",
            "Fan Belt",
            "Fan Belt Tensioner",
            "Fan Blade",
            "Fan Clutch",
            "Fan Shroud",
            "Fascia Panel Around Heater Controls",
            "Filters Bracket",
            "Fire Extinguisher + Mount",
            "First Aid Panel Cover",
            "Flasher/Hazard Relay",
            "Flex Plate",
            "Floor Mats",
            "Floor Pan",
            "Floor Panel",
            "Flywheel",
            "Fog Lamp",
            "Fog Light Bezel",
            "Fog Light Blank",
            "Fog Light Switch",
            "Footpeg",
            "Fork (Front/Left)",
            "Fork (Front/Right)",
            "Fork Cap",
            "Fork Fairing",
            "Front End Assem.",
            "Front Panel",
            "Fuel Burning Heater",
            "Fuel Cap",
            "Fuel Cooler",
            "Fuel Filler Flap",
            "Fuel Filler Pipe",
            "Fuel Filter",
            "Fuel Filter Housing",
            "Fuel Injection Pump",
            "Fuel Injector",
            "Fuel Lever Sensor",
            "Fuel On/Off Bfly Switch",
            "Fuel Pipe",
            "Fuel Pump",
            "Fuel Pump Cover",
            "Fuel Pump Relay",
            "Fuel Sending Unit",
            "Fuel Tank",
            "Fuse Box",
            "Gasket",
            "Gear Gaiter",
            "Gear Linkage",
            "Gear Rods",
            "Gear Stick/Shifter",
            "Gearbox ",
            "Gearbox (Manual)",
            "Gearbox Cables",
            "Gearbox Cooler",
            "Gearbox Crossmember",
            "Gearbox Lines",
            "Gearbox Mount",
            "Gearbox Under-Shield",
            "Gearstick",
            "Gearstick Surround",
            "Glove Box",
            "Glow Plug",
            "Glow Plug Control Module/Relay",
            "Grab Handle",
            "Grille",
            "Grille - Lower",
            "Handbook",
            "Handbrake Cable",
            "Handbrake Lever/Assy",
            "Handbrake Valve",
            "Handle Bar",
            "Handlebar Grip",
            "Hanger (Front/Left)",
            "Hanger (Front/Right)",
            "Hanger (Rear/Rear)",
            "Hanger (Rear/Right)",
            "Hard Top",
            "Hazard Switch",
            "Headlamp (Left)",
            "Headlamp (Right)",
            "Headlamp Washer Jet",
            "Headlight",
            "Headlight Ballast",
            "Headlight Bracket (Left)",
            "Headlight Bracket (Right)",
            "Headlight Cowl",
            "Headlight Door (Left)",
            "Headlight Door (Right)",
            "Headlight Loom",
            "Headlight Motor (Left)",
            "Headlight Motor (Right)",
            "Headlight Panel",
            "Headlight Relay",
            "Headlight Switch",
            "Headliner",
            "Headrest",
            "Heated Seat Switches",
            "Heater & Clock Surround",
            "Heater (Right)Eostat",
            "Heater Blower Motor",
            "Heater Control Panel & Stereo - Digital",
            "Heater Control Valve",
            "Heater Core",
            "Heater Motor/Assy",
            "Heater Surround Trim",
            "Heater/Ac Controller",
            "Height Sensor (Front)",
            "Height Sensor (Rear)",
            "Hood And Frame",
            "Hood/Soft Top Catch",
            "Horn",
            "HT Lead",
            "Hub (Front)",
            "Hub (Rear)",
            "Hub/Stub Axl.Assy (Front/Left)",
            "Hub/Stub Axl.Assy (Front/Right)",
            "Hub/Stub Axl.Assy (Rear/Left)",
            "Hub/Stub Axl.Assy (Rear/Right)",
            "Hybrid Battery Cell",
            "Hydroelastic Shock",
            "I-Beam (Left)",
            "I-Beam (Right)",
            "Idle Spd.Cont.Valve",
            "Idler Arm",
            "Ignition Coil",
            "Ignition W/ Key",
            "In-Boot Speaker Unit & Amp",
            "Indicator Light (Left)",
            "Indicator Light (Right)",
            "Indicator Stalk",
            "Injection Rail",
            "Injector Pump",
            "Inlet Valve",
            "Inlet Manifold Gasket",
            "Inner Structure",
            "Intake Manifold",
            "Intercooler",
            "Intercooler Pipes",
            "Interior Complete",
            "Interior Grab Handle",
            "Interior Light",
            "Interior Light Panel",
            "Interior Tailgate Panel",
            "Intermediate Pipe",
            "Intermediate Shaft",
            "Jack",
            "Jack/Tool Kit",
            "Key Fob",
            "Knock Sensor",
            "Ladder",
            "Lambda / Oxygen Sensor",
            "Lamp Guard",
            "Leaf Spring (Front)",
            "Leaf Spring (Rear)",
            "Lights Junction Box",
            "Load Liner",
            "Lock Set + Keys Compl",
            "Locking Wheel Nut Set",
            "Loud Speaker Centre Dash ",
            "Loud Speakers",
            "Lower Control Arm (Front/Left)",
            "Lower Control Arm (Front/Right)",
            "Lower Control Arm (Rear/Left)",
            "Lower Control Arm (Rear/Right)",
            "Luggage Cover",
            "Map Sensor",
            "Master Cyl.Reservoir",
            "Master Cylinder",
            "MC (Front) Hub",
            "Mid/Link Pipe",
            "Mirror (Interior)",
            "Mirror Switch",
            "Misc",
            "Misc Bracket",
            "Misc Fuel Inj Part",
            "Misc Padding/Trim",
            "Misc Pulley",
            "Misc Relay",
            "Misc Switch",
            "Mud Flap",
            "Mudguard (Front)",
            "Mudguard (Rear)",
            "Multifunction Computer Switch",
            "Mushrooms",
            "Nosecone",
            "Number Plate Holder",
            "Number Plate Lamp",
            "Number Plate Panel",
            "Oil Balancer Unit",
            "Oil Cooler",
            "Oil Filler Cap",
            "Oil Filter",
            "Oil Filter Housing",
            "Oil Level Sensor",
            "Oil Pan/Sump",
            "Oil Pressure Dial",
            "Oil Pressure Sensor",
            "Oil Pressure Switch",
            "Oil Pump",
            "Oil Tank",
            "Overdrive Unit",
            "Overflow Bottle",
            "Owners Manual",
            "Oxygen Sensor",
            "Panel (Rear)",
            "Panhard Rod (Front)",
            "Panhard Rod (Rear)",
            "Parcel Shelf",
            "Parking Brake Motor",
            "Parking Sensor (Front)",
            "Parking Sensor (Rear)",
            "Particulate Filter (Dpf)",
            "Pas Reservoir",
            "Pedal Box",
            "Pedal Potentiometer",
            "Pipes/Hoses-Act.Susp",
            "Piston",
            "Power Steering Cooler",
            "Power Steering Fluid",
            "Power Steering Pipes",
            "Power Steering Pulley",
            "Power Steering Pump",
            "Power Valve Motor",
            "Pressure Plate",
            "Pressure Regulator",
            "Primer Pump",
            "Propshaft (Front/Comp)",
            "Propshaft (Rear)",
            "Propshaft Tube",
            "Qtr Window Latch",
            "Qtr Wnd Motor (Left)",
            "Qtr Wnd Motor (Right)",
            "Quarter Extension",
            "Quarter Light (Front/Left)",
            "Quarter Light (Front/Right)",
            "Quarter Light (Rear/Left)",
            "Quarter Light (Rear/Right)",
            "Quarter Panel (Left)",
            "Quarter Panel (Right)",
            "Quarter Wnd Regulator",
            "Radiator",
            "Radiator Expansion Bottle",
            "Radiator Fan / Cowling",
            "Radiator Pack",
            "Radiator Support",
            "Radio",
            "Radio Display",
            "Ram - Act.Susp (Rear)",
            "Rear Screen",
            "Rear Trailing Arm",
            "Regulator/Rectifier",
            "Repeater Lamp (Left)",
            "Repeater Lamp (Right)",
            "Rev Counter",
            "Reversing Light",
            "Reversing Light Switch",
            "Ring Gear/Pinion",
            "Rocker Cover Gasket",
            "Rollcage",
            "Roof",
            "Roof Glass/Sunroof/T",
            "Roof Rack/Bars",
            "Roof Rail",
            "Rotary Coupling",
            "Sat. Nav. Unit",
            "Scuttle Panel",
            "Seal",
            "Seat (Front/Left)",
            "Seat (Front/Right)",
            "Seat (Rear) ",
            "Seat (Rear) 3Rd",
            "Seat Belt (Front/Left)",
            "Seat Belt (Front/Right)",
            "Seat Belt (Rear/Left)",
            "Seat Belt (Rear/Right)",
            "Seat Belt Motor",
            "Seat Belt Pretensioner",
            "Seat Belt Stalk",
            "Seat Box",
            "Seat Catch",
            "Seat Cover",
            "Seat Switch",
            "Seat Track",
            "Service Kit",
            "Shaft Coupling",
            "Shock/Strut (Front/Left)",
            "Shock/Strut (Front/Right)",
            "Shock/Strut (Rear/Left)",
            "Shock/Strut (Rear/Right)",
            "Side Door Handle Exterior",
            "Side Glass (Rear/Left)",
            "Side Glass (Rear/Right)",
            "Side Load Door",
            "Side Skirt",
            "Side Stand Switch",
            "Side Step/Rail",
            "Side/Centre Stand",
            "Sidelight/Drl (Left)",
            "Sidelight/Drl (Right)",
            "Silencer",
            "Silencer / End Can",
            "Sill",
            "Silver Trim Around Vents",
            "Slam Panel",
            "Sliding Door Lock Mech",
            "Sliding Door Roller Bracket",
            "Slip Yoke",
            "Space Saver Wheel",
            "Spare Tyre/Carrier",
            "Spare Wheel Cover",
            "Spare Wheel Foam",
            "Spare Wheel Panel",
            "Spark Plug",
            "Speedo Clocks & Rev Counter",
            "Speedo Cowl",
            "Speedo Cowling",
            "Speedo Sensor/Sender",
            "Speedometer",
            "Speedometer Cable",
            "Spi Unit",
            "Spindle (Front)",
            "Spindle (Rear)",
            "Spindle (Rear/Left)",
            "Spindle (Rear/Right)",
            "Spoiler (Front)",
            "Spoiler (Rear)",
            "Spotlight",
            "Sprocket",
            "Stabilizer Arm",
            "Stabilizer Bar",
            "Stablizer Link Rod Front",
            "Stalk",
            "Starter",
            "Steering Box",
            "Steering Collar",
            "Steering Column",
            "Steering Coupling",
            "Steering Cowl",
            "Steering Damper",
            "Steering Gearboxes",
            "Steering Hose",
            "Steering Knuckle",
            "Steering Pump",
            "Steering Rack (Manual)",
            "Steering Rack (Power)",
            "Steering Wheel",
            "Step (Rear)",
            "Stereo Controls",
            "Stereo Cover",
            "Stereo System",
            "Stoplight High Level",
            "Strut (Front/Left)",
            "Strut (Front/Right)",
            "Strut (Rear/Left)",
            "Strut (Rear/Right)",
            "Strut/Shock (Hatch)",
            "Subframe (Front)",
            "Subframe (Rear)",
            "Sump Guard",
            "Sunglass Holder",
            "Sunroof",
            "Sunroof Blind",
            "Sunroof Control Panel",
            "Sunroof Deflector",
            "Sunroof Motor",
            "Sunroof Rear (Electric)",
            "Sunvisor",
            "Supercharger",
            "Supercharger Cooling Radiator",
            "Suspension Air Sack (Front)",
            "Suspension Air Sack (Rear)",
            "Suspension Complete (Front/Left)",
            "Suspension Complete (Front/Right)",
            "Suspension Complete (Rear)",
            "Suspension Complete (Rear/Left)",
            "Suspension Complete (Rear/Right)",
            "Suspension Fluid Tank",
            "Suspension Pump",
            "Suspension Sphere",
            "Sway Bar (Rear)",
            "Swing Arm",
            "Swing Arm (Front)",
            "Swing Arm Spindle",
            "Swirl Flap Motor",
            "Switch Bank - Electric Mirror/Fog ",
            "Switch Gear (Left)",
            "Switch Gear (Right)",
            "Tachograph",
            "Tachometer",
            "Tail Blazer",
            "Tail Lift Ramp",
            "Tail Light",
            "Tail Light (Left)",
            "Tail Light (Right)",
            "Tail Piece",
            "Tail Pipe",
            "Tailgate",
            "Tailgate Button",
            "Tailgate Glass (Opening)",
            "Tailgate Glass (Opening)",
            "Tailgate Glass (Rear)",
            "Tailgate Handle",
            "Tailgate Hinges",
            "Tailgate Light Panel",
            "Tailgate Lock Mech",
            "Tailgate Mech Plastic Surround",
            "Tailgate Panel Trim",
            "Tailgate Plastic/Bottom Trim",
            "Tailgate Power Lift Motor",
            "Tailgate Regulator",
            "Tailgate Struts",
            "Tailgate Window Locking Mech",
            "Tailgate Window Mech",
            "Tailgate Window Struts",
            "Tape Head Unit",
            "Thermostat",
            "Thermostat Housing",
            "Throttle Body",
            "Throttle Cables",
            "Throttle Position Sw",
            "Throttle Tube",
            "Throwout Bearing",
            "Tie Bar (Rear)",
            "Tie Rod (Front)",
            "Tie Rod End",
            "Tilt Sensor",
            "Time Clock",
            "Time Clock, Temp & Fuel Gauges",
            "Timing Belt",
            "Timing Chain",
            "Timing Cover",
            "Tonneau/Soft Top Cover",
            "Tool Kit",
            "Top Strut Mount",
            "Top Yoke",
            "Torque Converter",
            "Torsion Bar (Front)",
            "Torsion Bar (Rear)",
            "Towbar",
            "Track Rod",
            "Track Rod End",
            "Traction Control Button",
            "Traction Control Unit",
            "Trailer Hitch",
            "Trans Fluid",
            "Transfer Box/Case",
            "Transfer Case Elec. Mtr",
            "Transfer Shaft (Front)",
            "Trim Panel",
            "Truck Cab",
            "Tunnel",
            "Turbo Actuator",
            "Turbo Manifold",
            "Turbocharger",
            "Tv & Antennae Boxes Unit",
            "Tyre (25 Profile)",
            "Tyre (30 Profile)",
            "Tyre (35 Profile)",
            "Tyre (40 Profile)",
            "Tyre (45 Profile)",
            "Tyre (50 Profile)",
            "Tyre (55 Profile)",
            "Tyre (60 Profile)",
            "Tyre (65 Profile)",
            "Tyre (70 Profile)",
            "Tyre (75 Profile)",
            "Tyre (80 Profile)",
            "Tyre (85 Profile)",
            "Tyre (90 Profile)",
            "Tyre (95 Profile)",
            "Tyre Pressure Sensor",
            "Under-Bonnet Intercooler Pipes",
            "Under-Bonnet Light",
            "Under-Seat Tray",
            "Undertray/Light Surr",
            "Upper Cont Arm (Rear/Left)",
            "Upper Cont Arm (Rear/Right)",
            "Upper Control Arm (Front/Left)",
            "Upper Control Arm (Front/Right)",
            "Vacuum Pump",
            "Vacuum Solenoid Valve",
            "Valance Front",
            "Valve Block-Act.Susp",
            "Vents",
            "Viscous Fan",
            "Warning Triangle",
            "Washer Bottle",
            "Washer Jet",
            "Washer Pump",
            "Water Bottle",
            "Water Heater (Aux)",
            "Water Pump",
            "Wheel - Centre Cap",
            "Wheel (Alloy)",
            "Wheel (Alloy) Set 4",
            "Wheel (Spare)",
            "Wheel (Spare) Support",
            "Wheel (Steel)",
            "Wheel (Steel) Set 4",
            "Wheel Adjuster",
            "Wheel Arch/Spat",
            "Wheel Bearing",
            "Wheel Cover/Hub Cap",
            "Wheel Nut",
            "Wheel Trim",
            "Windbreaker",
            "Window Crank",
            "Window Regulator (Front/Left)",
            "Window Regulator (Front/Right)",
            "Window Regulator (Rear/Left)",
            "Window Regulator (Rear/Right)",
            "Window Switch Panel",
            "Window Switches Centre",
            "Window/Mirror Switch Bank",
            "Windscreen",
            "Windscreen Frame",
            "Wing & Arch Trim",
            "Wing (Front/Left)",
            "Wing (Front/Right)",
            "Wing Bracket (Front)",
            "Wing Liner/Inner",
            "Wing Mirror (Left)",
            "Wing Mirror (Right)",
            "Wing Mirror Support (Left)",
            "Wing Mirror Support (Right)",
            "Wing Molding",
            "Wiper Arm (Front)",
            "Wiper Arm (Rear)",
            "Wiper Assembly",
            "Wiper Blade ",
            "Wiper Linkage",
            "Wiper Motor (Front)",
            "Wiper Motor (Rear)",
            "Wire Harness",
            "Wooden Fascia Panel",
            "Wooden Trim Around Gearstick And Stereo Controls",
            "Engine (Excl. Ancills)",
            "Gearbox",
        ];

        $seed_data = [];
        $i = 0;
        foreach ($types as $type) {
            $seed_data[$i]['name'] = $type;
            $seed_data[$i]['predefined'] = 1;
            $seed_data[$i]['created_at'] = Carbon\Carbon::now();
            $seed_data[$i]['updated_at'] = Carbon\Carbon::now();
            $i++;
        }
        // generate the default user roles
        DB::table('part_types')->insert($seed_data);
    }
}
