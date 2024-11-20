import React from "react";
import { useQuery } from "react-query";
import {
  Card,
  CardHeader,
  CardContent,
  CardActions,
  Avatar,
  Badge,
  Typography,
  Box,
  Button,
  Grid,
} from "@mui/material";
import { getAllHistory } from "../../../services/api";

const Dashboard = () => {
  const { data: historyData } = useQuery(["allHistoryData"], () =>
    getAllHistory()
  );

  return (
    <Box>
      {/* Project Description Section */}
      <Box
        sx={{
          backgroundColor: "primary.light",
          color: "primary.contrastText",
          padding: 4,
          borderRadius: 2,
          mb: 4,
        }}
      >
        <Typography variant="h4" color="inherit" gutterBottom>
          Welcome to the Plant History Dashboard
        </Typography>
        <Typography variant="body1" color="inherit" paragraph>
          This dashboard provides an overview of all the historical data related
          to plants in our system. You can explore the details about each plant,
          including its name, category, description, and the user who interacted
          with it. Stay informed and track plant data efficiently!
        </Typography>
      </Box>

      {/* No Data Message if No History Data */}
      {!historyData || historyData.length === 0 ? (
        <Box
          display="flex"
          justifyContent="center"
          alignItems="center"
          height="100vh"
          flexDirection="column"
          p={4}
        >
          <Typography variant="h4" color="text.primary" align="center" mb={2}>
            No Plant History Found
          </Typography>
          <Typography
            variant="body1"
            color="text.secondary"
            align="center"
            mb={3}
          >
            It looks like there’s no plant history available at the moment.
          </Typography>
          <Button
            variant="contained"
            color="primary"
            sx={{ fontSize: "1rem" }}
            onClick={() => window.location.reload()}
          >
            Refresh
          </Button>
        </Box>
      ) : (
        // History Data Section
        <Box
          display="grid"
          gridTemplateColumns={{
            xs: "1fr",
            md: "repeat(2, 1fr)",
            lg: "repeat(3, 1fr)",
          }}
          gap={4}
          p={4}
        >
          {historyData?.map((history: any) => (
            <Card key={history.id} sx={{ width: "100%" }}>
              <CardHeader
                title={
                  <Typography variant="subtitle1">Plant History</Typography>
                }
                subheader={
                  <Badge
                    badgeContent={new Date(
                      history.createdAt
                    ).toLocaleDateString()}
                    color="primary"
                    sx={{ fontSize: "0.8rem", padding: "4px" }}
                  />
                }
                sx={{
                  display: "flex",
                  justifyContent: "space-between",
                  alignItems: "center",
                }}
              />
              <CardContent>
                <Box display="flex" alignItems="center" mb={2}>
                  <Avatar
                    src={history.plantData.imageUrl}
                    alt={history.plantData.name}
                    sx={{ width: 64, height: 64, marginRight: 2 }}
                  >
                    {history.plantData.name.charAt(0)}
                  </Avatar>
                  <Box>
                    <Typography variant="h6">
                      {history.plantData.name}
                    </Typography>
                    <Typography variant="body2" color="text.secondary">
                      {history.plantData.category}
                    </Typography>
                  </Box>
                </Box>
                <Typography variant="body2" color="text.secondary">
                  {history.plantData.description}
                </Typography>
              </CardContent>
              <CardActions sx={{ justifyContent: "space-between", padding: 2 }}>
                <Box>
                  <Typography variant="body2" fontWeight="medium">
                    User: {history.user.username}
                  </Typography>
                  <Typography variant="body2" color="text.secondary">
                    {history.user.email}
                  </Typography>
                </Box>
              </CardActions>
            </Card>
          ))}
        </Box>
      )}
    </Box>
  );
};

export default Dashboard;
