import * as React from "react";
import { styled, useTheme } from "@mui/material/styles";
import Drawer from "@mui/material/Drawer";
import LayerPanel from "../LayerPanel/LayerPanel";
import LayerPanelTree from "../LayerPanel/LayerPanelTree";
import { Box } from "@mui/material";
import LayerPanelCheckbox from "../LayerPanel/LayerPanelCheckBox";

export const DrawerHeader = styled("div")(({ theme }) => ({
  display: "flex",
  alignItems: "center",
  padding: theme.spacing(0, 1),
  // necessary for content to be below app bar
  ...theme.mixins.toolbar,
  justifyContent: "flex-end",
}));

const SidePanel = ({ open, drawerWidth }) => {
  const theme = useTheme();
  return (
    <Drawer
      sx={{
        width: drawerWidth,
        flexShrink: 0,
        "& .MuiDrawer-paper": {
          width: drawerWidth,
          boxSizing: "border-box",
        },
      }}
      variant="persistent"
      anchor="left"
      open={open}
    >
      <DrawerHeader></DrawerHeader>
      <Box sx={{mt:1}}>
      {/* <LayerPanelTree /> */}
      {/* <LayerPanelCheckbox /> */}
      <LayerPanel />
      </Box>
    </Drawer>
  );
};

export default SidePanel;
